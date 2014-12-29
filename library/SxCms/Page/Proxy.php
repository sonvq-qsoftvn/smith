<?php

/**
 * Development by thieusmith
 * @version $Id: Acl.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. thieusmith can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Acl
 * @copyright  Copyright (c) 2015 thieusmith. (thieusmith@gmail.com)
 */

class SxCms_Page_Proxy
{
    protected static $mapper;

    public function __construct()
    {
        if (!self::$mapper) {
            self::$mapper = new SxCms_Page_DataMapper();
        }
    }
    
    protected function _getCollection($rowset, $lng = 'nl')
    {
        $pages = array();
        foreach ($rowset as $page) {
            $pageObject = $this->_getModelFromArray($page);
            $pages[$pageObject->getId()] = $pageObject;
        }

        $pages = $this->_collectPermissions($pages);
        $pages = $this->_collectRevisions($pages, $lng);
        return $pages;
    }

    protected function _getModelFromArray($array)
    {
        $pageObject = new SxCms_Page();
        self::$mapper->map($array, $pageObject);

        return $pageObject;
    }

    protected function _collectPermissions($pageObject)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from(array('p' => 'PageAcl'), array('*'))
            ->join(array('g' => 'Group'), 'p.group_id = g.group_id');

        if ($pageObject instanceof SxCms_Page) {
            $select->where('page_id = ?', $pageObject->getId());
		} else if (is_array($pageObject) && count($pageObject)) {
			$select->where('page_id IN (?)', array_keys($pageObject));
        } else {
        	return $pageObject;
        }

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        foreach ($result as $row) {
        	$group = new SxCms_Group();
        	$group->setId($row['group_id'])
        	      ->setIdentifier($row['identifier'])
        	      ->setName($row['name']);

            if ($pageObject instanceof SxCms_Page) {
        	    $pageObject->addPermission($group);
            } else {
                $pageObject[$row['page_id']]->addPermission($group);
            }
        }

        return $pageObject;
    }

    protected function _collectRevisions($pageObject, $lng = 'nl')
    {
        $db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('r' => 'PageRev'), array('*'))
			->joinLeft(array('p' => 'Page'), 'p.page_id = r.page_id')
			->where('r.language = ?', $lng)
			->order('revision_id DESC');

        if ($pageObject instanceof SxCms_Page) {
            $select->where('p.page_id = ?', $pageObject->getId());
        } else if (is_array($pageObject) && count($pageObject)) {
        	$select->where('p.page_id IN (?)', array_keys($pageObject));
        } else {
            return $pageObject;
        }
	
		$stmt = $db->query($select);
		$revisions = $stmt->fetchAll();

		foreach ($revisions as $revision) {
			$revObj = new SxCms_Page_Revision();
			$revObj->setFromArray($revision);

            if ($pageObject instanceof SxCms_Page) {
        	    $pageObject->addRevision($revObj);
            } else {
                $pageObject[$revision['page_id']]->addRevision($revObj);
            }
		}

        return $pageObject;
    }
    
	public function getPageRevisions($pageId, $language = 'nl')
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageRev'), 'p.page_id = t.page_id')
			->where('p.page_id = ?', $pageId)
			->where('t.language = ?', $language)
			->order('t.revision_id DESC');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$revisions = array();
		foreach ($result as $revision) {
			$rev = new SxCms_Page_Revision();
			$rev->setFromArray($revision);

			$revisions[$rev->getId()] = $rev;
		}

		return $revisions;
	}

	public function getPageByRevisionId($revisionId, $language = 'nl')
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageRev'), 'p.page_id = t.page_id')
			->join(array('tsl' => 'PageTsl'), 'p.page_id = tsl.page_id')
			->where('t.revision_id = ?', $revisionId)
			->where('t.language = ?', $language);

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

        $page = $this->_getModelFromArray($result[0]);
		
		return $page;
	}

	public function getPagesByParentId($parentId, $skip = null, $language = 'nl', $sort = true, $activeOnly = false)
	{
		$cacheId = 'getPagesByParentId_' . (int) $parentId . (int) $skip . $language . (int) $sort . (int) $activeOnly;
		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->where('p.parent_id = ?', $parentId)
			->where('p.page_id != 0')
			->order('p.parent_id ASC')
            ->where('p.type != ' . SxCms_Page::ARTICLE);

        if ($skip && $skip->getId()) {
            $select->where('p.page_id != ?', $skip->getId());
		}
		
		if ($language) {
			$select->where('t.language = ?', $language);
        }
		
		if ($activeOnly) {
			$select->where('date_published <= NOW() OR date_published IS NULL');
            $select->where('date_expired >= NOW() OR date_expired IS NULL');
			$select->where('t.invisible = 0');
		}

		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
		$pages  = $this->_getCollection($result);

		if ($sort) {
			$mapper = new SxCms_Page_TreeMapper();
			$mapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

			$order = $mapper->getChildOrder($parentId);
			$sorted = array();
			foreach ($order as $id) {
				if (isset($pages[$id])) {
					$sorted[$id] = $pages[$id];
				}
			}

			$pages = $sorted;
		}
        
		$cache->save($pages, $cacheId, array('SxCms_Page'));
		return $pages;
	}

	public function getAll($lng = 'nl')
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->where('t.language = ?', $lng)
			->order('p.parent_id ASC');
			

		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
        $pages  = $this->_getCollection($result, $lng);

		return $pages;
	}

	public function getExpired($lng = 'nl', $type = false)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->order('p.parent_id ASC')
            ->where('t.language = ?', $lng);
			

        $select->where('date_expired < CURDATE()');
		
		if ($type) 
			 $select->where('p.type = ' . $type);	
		else
			$select->where('p.type != ' . SxCMS_Page::ARTICLE);	
        
		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
		$pages  = $this->_getCollection($result, $lng);

		return $pages;
	}
	
	public function getNotActive($lng = 'nl', $type = false)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->order('p.parent_id ASC')
            ->where('t.language = ?', $lng)
			->where('t.invisible = 1');
			
		if ($type) 
			 $select->where('p.type = ' . SxCMS_Page::ARTICLE);	
		else
			$select->where('p.type != ' . SxCMS_Page::ARTICLE);	
        
		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
		$pages  = $this->_getCollection($result, $lng);

		return $pages;
	}

	public function getNearlyExpired($days = 10, $lng = 'nl', $type= false)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->order('p.parent_id ASC')
            ->where('t.language = ?', $lng)
            ->where("DATEDIFF(p.date_expired, CURDATE()) < ?", $days)
            ->where("DATEDIFF(p.date_expired, CURDATE()) > 0");
			
		if ($type) 
			 $select->where('p.type = ' . SxCMS_Page::ARTICLE);	
		else 
			$select->where('p.type != ' . SxCMS_Page::ARTICLE);	

		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
		$pages  = $this->_getCollection($result, $lng);

		return $pages;
	}

    public function getTranslationRequired($lng = 'nl', $type= false)
    {
		$db = Zend_Registry::get('db');
		
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->order('p.parent_id ASC')
            ->where('t.language = ?', $lng)
            ->where('t.final = 1');

		if ($type) 
			 $select->where('p.type = ' .  SxCMS_Page::ARTICLE);	
		else 
			$select->where('p.type != ' . SxCMS_Page::ARTICLE);	
		
		$stmt   = $db->query($select);
		$result = $stmt->fetchAll();
		$pages  = $this->_getCollection($result, $lng);

		return $pages;
    }
    
	public function getPageById($page_id, $language = null)
	{
		$lng = isset($_SESSION['System']['lng']) ? $_SESSION['System']['lng'] : 'nl';
        if ($language) {
        	$lng = $language;
        }
	
		$cacheId = 'getPageById_' . (int) $page_id . $lng;
		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->where('p.page_id = ?', $page_id)
			->where('t.language = ?', $lng);

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$page = $this->_getModelFromArray($result[0]);
        $page = $this->_collectPermissions($page);
        $page = $this->_collectRevisions($page, $lng);

		$cache->save($page, $cacheId, array('SxCms_Page'));
		return $page;
	}

	public function getPageByUrl($url = null, $types = null, $lng = 'nl')
	{
	
		if (is_null($types)) {
			$types = array(
				SxCms_Page::INTERNAL,
				SxCms_Page::EXTERNAL,
				SxCms_Page::ARTICLE,
				SxCms_Page::SUMMARY
			);
		}

		$cacheId = 'getPageByUrl_' . md5($url . implode('_', $types) . $lng);

		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
		    ->where('t.language LIKE ?', $lng)
			->where('p.type IN (?)', $types);

		if (is_null($url)) {
			$select->where('t.link IS NULL');
		} else {
			$select->where('t.link = ?', $url);
		}

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();
		end($result);

        $page = $this->_getModelFromArray(current($result));
        $page = $this->_collectPermissions($page);
        $page = $this->_collectRevisions($page, $lng);

		$cache->save($page, $cacheId, array('SxCms_Page'));
		return $page;
	}

	public function getSiteTree($lng = 'nl', $news = false, $limit = null, $activeOnly = false)
	{
		$cacheId = 'getSiteTree_' . $lng . (int) $news . (int) $limit . (int) $activeOnly;
		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			return $result;
		}
		
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->group('p.page_id')
			->where('t.language = ?', $lng);

        switch($news) {
            case true:
                $select->order('p.date_published DESC');
                $select->where('p.type = ' . SxCms_Page::ARTICLE);
                break;
            case false:
                $select->order('p.parent_id ASC');
                $select->where('p.type != ' . SxCms_Page::ARTICLE);
                break;
        }

        if ($limit) {
            $select->order('p.date_published');
            $select->limit($limit);
        }
        
		if ($activeOnly) {
            $select->where('date_published <= NOW() OR date_published IS NULL');
            $select->where('date_expired >= NOW() OR date_expired IS NULL');
			$select->where('invisible = 0');
        }
        
		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$tree = array();
		foreach ($result as $page) {
            $pageObject = $this->_getModelFromArray($page);
	
			$tree[$page['page_id']] = $pageObject;
	
			if (isset($tree[$page['parent_id']]) && $page['parent_id'] !== $page['page_id']) {
				$tree[$page['parent_id']]->addChild($pageObject);
			}
			
		}

        $tree = $this->_collectPermissions($tree);
        $tree = $this->_collectRevisions($tree);

		$cache->save($tree, $cacheId, array('SxCms_Page'));
		
		return $tree;
	}

	public function getSiteTreeHtml($lng = 'nl', $href = null)
	{
		$tree = $this->getSiteTree($lng);
		return $this->_getRecursiveTree($tree, $lng, $href);
    }

    protected function _getRecursiveTree($tree, $lng = 'nl', $href = null, $nodeId = 0)
    {
		$html = '<li>';
        if (isset($tree[$nodeId])) {
        	if ($href) {
        		$link = str_replace('%id%', $nodeId, $href);
        		$html .= '<a href="' . $link . '">';
        	}

            $html .= htmlentities($tree[$nodeId]->getTitle(), ENT_QUOTES, 'utf-8');
            if ($href) {
            	$html .= '</a>';
            }
        }

        if (!$tree[$nodeId]->getChildren()) {
            $html .= '</li>' . "\n";
        } else {
			$html .= "<ul>\n";
	        foreach ($tree[$nodeId]->getChildren() as $child) {
	            $html .= $this->_getRecursiveTree($tree, $lng, $href, $child->getId());
	        }
	        $html .= "</ul>\n";
        }

		return $html;
    }

	public function search($search)
	{
		$db = Zend_Registry::get ('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')	

			->where("language = ?", $_SESSION['System']['lng'])		
			->where('title LIKE ?', '%'.$search.'%')
			->orWhere('content LIKE ?', '%'.$search.'%')
			->orWhere('source LIKE ?', '%'.$search.'%')
			->orWhere('link LIKE ?', '%'.$search.'%');

		$results = $db->fetchAll($select);
        $pages = $this->_getCollection($results);

		return $pages;
	}

	public function getArticlesByYear($lng = 'nl', $year = 2010)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->join(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
			->group('p.page_id')
			->where('t.language = ?', $lng)
			->where('p.type = ' . SxCms_Page::ARTICLE)
			->where('DATE_FORMAT(p.date_created, "%Y") = ?', $year)
			->order('p.date_published DESC');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$tree = array();
		foreach ($result as $page) {
            $pageObject = $this->_getModelFromArray($page);
			$tree[$page['page_id']] = $pageObject;

			if (isset($tree[$page['parent_id']]) && $page['parent_id'] !== $page['page_id']) {
				$tree[$page['parent_id']]->addChild($pageObject);
			}
		}

        $tree = $this->_collectPermissions($tree);
        $tree = $this->_collectRevisions($tree);
        
		return $tree;
	}

	public function getLinkStatus()
	{
        $tree = $this->getSiteTree();

        $stack = array();
        foreach ($tree as $page) {
            $dom = new DOMDocument();
            @$dom->loadHTML($page->getContent());

            $xpath = new DOMXPath($dom);
            $hrefs = $xpath->evaluate("//a");

            $stack[$page->getId()] = array();
            for ($i = 0; $i < $hrefs->length; $i++) {
                $href = $hrefs->item($i);
                $url = $href->getAttribute('href');

                if (strpos($url, '/') !== 0) {
                	continue;
                }

                $url  = Zend_Registry::get('config')->system->web->url . $url;
				$host = parse_url($url, PHP_URL_HOST);
						
				if ($host == $_SERVER['SERVER_ADDR']) { // check if it points to an internal ip address
					$stack[$page->getId()][] = $href->parentNode->nodeValue . ' [ ' . $url . ' ]';
				} else {
					try {
						$client = new Zend_Http_Client();
						$client->setUri($url);
						$client->setConfig(array(
								'maxredirects' => 3,
								'timeout'      => 10,
							)
						);

						$response = $client->request('HEAD');
						if ($response->getStatus() && $response->isError()) {
							$stack[$page->getId()][] = 'ERROR ' . $response->getStatus() . ' ' .$href->parentNode->nodeValue . ' [ ' . $url . ' ]';
						}
					} catch (Exception $e) {
						$stack[$page->getId()][] = 'EXCEPTION: ' . $href->parentNode->nodeValue . ' [ ' . $url . ' ]';
					}
				}
            }
        }

        return array_filter($stack);
	}
}