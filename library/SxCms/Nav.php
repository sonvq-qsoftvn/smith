<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Page.php 8193 2010-05-28 11:49:09Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Nav
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Nav
{
    protected $language;
    protected $active;
    protected $bounds = array(
        'lower' => 0,
        'outer' => 1,
    );

    protected static $items = array();

    public function __construct($language)
    {
        $this->language = $language;
        if (!self::$items) {
            $this->reloadItems();
        }
    }

    public function reloadItems()
    {
        $pageProxy = new SxCms_Page_Proxy();
        $xmlMapper = new SxCms_Page_TreeMapper();
        $xmlMapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

        $items = $xmlMapper->map($pageProxy->getSiteTree($this->language, false, null, true));
		$menus = array();
		foreach ($items as $page) {
            if (strtotime($page->getDatePublished()) <= time() &&
               (strtotime($page->getDateExpired()) >= time() || is_null($page->getDateExpired()) && ($page->getInvisible() == 0))
            ) {
                $page->setActive(false);
                $menus[$page->getId()] = $page;
            }
        }

        self::$items = $menus;
    }
    
    public function setActivePage(SxCms_Page $page)
    {
        $this->active = $page;
        return $this;
    }

    public function getActivePage()
    {
        return $this->active;
    }

    public function setBounds($lower, $outer)
    {
        if ($outer < $lower or $lower < 0 or $outer < 0) {
            throw new InvalidArgumentException('Invalid lower/outer depth');
        }
        
        $this->bounds['lower'] = (int) $lower;
        $this->bounds['outer'] = (int) $outer;
        
        return $this;
    }

    public function getLowerBound()
    {
        return $this->bounds['lower'];
    }

    public function getOuterBound()
    {
        return $this->bounds['outer'];
    }

    public function items()
    {
        $menus = array();
        foreach (self::$items as $menu) {
		
            if ($menu->getLevel() >= $this->getLowerBound() && $menu->getLevel() <= $this->getOuterBound() ) {
		
				//if($menu->isInNavigation() && $menu->getParent()->isInNavigation())
	                $menus[$menu->getId()] = $menu;
            }
        }
		
        $this->_highlightActive($menus);
        return $menus;
    }
	
	 public function sitemapItems()
    {
        $menus = array();
        foreach (self::$items as $menu) {
		
            if ($menu->getLevel() >= $this->getLowerBound() && $menu->getLevel() <= $this->getOuterBound() ) {
				if($menu->isInSitemap())
	                $menus[$menu->getId()] = $menu;
            }
        }
		
        $this->_highlightActive($menus);
        return $menus;
    }
	
	

    public function breadcrumbs()
    {
        $menus = self::$items;
        $this->_highlightActive($menus);

        foreach ($menus as $id => $menu) {
            if (!$menu->isActive()) {
                unset($menus[$id]);
            }
        }

        return $menus;
    }
    
    protected function _highlightActive(&$menus)
    {
        if (false == ($page = $this->getActivePage())) {
            return $menus;
        }

        $id = $page->getId();
        $step = 0;
        do {
            if (isset($menus[$id])) {
                $menus[$id]->setActive();
            }

            if (!isset(self::$items[$id])) {
                $step += 1;
            } else {
                $id = self::$items[$id]->getParent()->getId();
            }
            
            $step += true == $id ? 0 : 1;
        } while ($step < 2 );
    }
}

