<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Page.php 9524 2010-10-22 07:23:03Z mindy $
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
 * @package    SxCms_Page
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Page
{
	// Page states
	const STATE_LIVE = 1;
	const STATE_REVISION = 2;

	// Page type
	const INTERNAL = 0;
	const EXTERNAL = 1;
	const ARTICLE  = 2;
	const SUMMARY  = 3;

	/**
	 * Unique page identifier
	 * @var integer
	 */
	protected $_id;

	/**
	 * Page type, defaults to internal page
	 * @var integer
	 */
	protected $_type = self::INTERNAL;

	/**
	 * Language identifier
	 * @var string
	 */
	protected $_language = 'nl';

	/**
	 * Page title
	 * @var string
	 */
	protected $_title;

	/**
	 * Fallback to dutch translation for title
	 * @var boolean
	 */
	protected $_titleFb = false;

	/**
	 * Page summary
	 * @var string
	 */
	protected $_summary;

	/**
	 * Fallback to dutch translation for summary
	 * @var boolean
	 */
	protected $_summaryFb = false;

	/**
	 * Page content
	 * @var string
	 */
	protected $_content;

	/**
	 * Fallback to dutch translation for content
	 * @var boolean
	 */
	protected $_contentFb = false;

	/**
	 * Page source
	 * @var boolean
	 */
	protected $_source;

	/**
	 * Fallback to dutch translation for source
	 * @var boolean
	 */
	protected $_sourceFb = false;

	/**
	 * External link
	 * @var string
	 */
	protected $_link;

	/**
	 * Fallback to dutch link
	 * @var boolean
	 */
	protected $_linkFb = false;

	/**
	 * Backreference to the page parent
	 * @var SxCms_Page
	 */
	protected $_parent;

	/**
	 * Author of the page
	 * @var SxCms_User
	 */
	protected $_author;

	/**
	 * Name of the template
	 * @var string
	 */
	protected $_layout = 'default';

	/**
	 * Flag that indicates if this is an external page
	 * @var boolean
	 */
	protected $_external = false;

	/**
	 * Flag that indicates if page is a news article
	 * @var boolean
	 */
	protected $_news = false;

	/**
	 * Flag that indicates if the page should be shown in the navigation
	 * @var booelan
	 */
	protected $_navigation = true;

	/**
	 * Flag that indicates if the page is visible in the sitemap
	 * @var boolean
	 */
	protected $_sitemap = true;

    protected $level = 0;
	/**
	 * Id of the page where the new page should be inserted/moved
	 * When this is set the item will be inserted in front of the item
	 *
	 * @var integer
	 */
	protected $_left;

	/**
	 * Id of the page where the new page should be inserted/moved
	 * When this is set the item will be inserted after the item
	 *
	 * @var integer
	 */
	protected $_right;

	/**
	 * Tags
	 * @var array
	 */
	protected $_tags = array();

    /**
     * User who locked the page
     * @var SxCms_User
     */
	protected $_lockedBy;

    /**
     * Date the page was locked (opened to edit)
     * @var string
     */
	protected $_dateLocked;
	
	/**
	 * Don't show page on website if checked
	 * @var int
	 */
	protected $_invisible;

	/**
	 * Date on which the page has been created
	 * @var string
	 */
	protected $_dateCreated;

	/**
	 * Date on which the page has been published
	 * @var string
	 */
	protected $_datePublished;

	/**
	 * Date on which the page has been expired or will expire
	 * @var string
	 */
	protected $_dateExpired;


	/**
	 * Date on which the page has been expired or will expire
	 * @var string
	 */
	 protected $_final;
	 
	 /**
	 * Title for SEO
	 * @var string
	 */
	 protected $_seotitle;
	 
	  /**
	 * Tags for SEO
	 * @var string
	 */
	 protected $_seotags;
	 
	 /**
	 * Description for SEO
	 * @var string
	 */
	 protected $_seodescription;
	 
	/**
	 * References the translations of the page
	 * @var array
	 */
	protected $_translations = array();

	/**
	 * Thumbnail filename
	 * @var string
	 */
	protected $_thumb;

    /**
     * Groups that are allowed to view this page
     * @var array
     */
	protected $_permissions = array();

    /**
     * Are comments allowed (used for news items)
     * @var boolean
     */
    protected $_comments = false;

    protected $children = array();
    protected $revisions = array();
    protected $active = false;
    protected $translationInvalid = false;
    
    /**
     * class constructor, initializes object
     * @return void
     */
	public function __construct()
	{
		$this->_language = SxCms_Global::$language;
	}

    /**
     * Returns the xml mapper object which defines the tree structure
     * 
     * @return SxCms_Page_TreeMapper
     */
	public function getXmlMapper()
	{
		$xmlMapper = new SxCms_Page_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

		return $xmlMapper;
	}

    /**
     * Sets the unique identifier of the page
     *
     * @param  integer $id
     * @return SxCms_Page
     */
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}

    /**
     * Get the unique identifier of the page.
     * When no id is set false is returned.
     * 
     * @return bool|int
     */
	public function getId()
	{
		if (!isset($this->_id)) {
			return false;
		}

		return $this->_id;
	}

    /**
     * Set language
     * 
     * @param  string $language
     * @return SxCms_Page
     */
	public function setLanguage($language)
	{
		$this->_language = strtolower($language);
		return $this;
	}

    /**
     * Get language
     * 
     * @return string
     */
	public function getLanguage()
	{
		return $this->_language;
	}

    /**
     * Validates if language has properly been seen
     *
     * @todo refactor in seperate validation object
     * @return bool
     */
	public function validateLanguage()
	{
		if (!isset($this->_language) || empty($this->_language)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('language', array('required' => 'You must select a language'));

			return false;
		}

		return true;
	}

    public function markTranslationInvalid()
    {
        $this->translationInvalid = true;
    }

    public function isTranslated()
    {
        return $this->translationInvalid;
    }

	/**
	 * Sets the title of the page.
	 * The title will be automaticly trimmed
	 *
	 * @param string $title
	 * @return SxCms_Page
	 */
	public function setTitle($title)
	{
		$this->_title = trim($title);
		return $this;
	}

    /**
     * Sets if the title should fallback to the main language
     * 
     * @param bool $fb
     * @return SxCms_Page
     */
	public function setTitleFallback($fb = true)
	{
		$this->_titleFb = (bool) $fb;
		if ($fb) {
			$this->_title = null;
		}

		return $this;
	}

    /**
     * Returns if there is a fallback to the main language for the title
     * 
     * @return bool
     */
	public function hasTitleFallback()
	{
		return $this->_titleFb;
	}

	/**
	 * Gets the title of the page
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * Validates the title
	 *
     * @todo refactor in seperate validation object
	 * @return boolean
	 */
	public function validateTitle()
	{
		if ($this->_titleFb) {
			return true;
		}

		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_title)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
		$msg->addMessage('title', $validator->getMessages(), 'title-summary');
		return false;
	}

	/**
	 * Sets the page summary. Page summary will be used
	 * for exporting pages for the newsletter and to display a
	 * summary on the homepage.
	 *
	 * @param string $summary
	 * @return SxCms_Page
	 */
	public function setSummary($summary)
	{
		$this->_summary = $summary;
		return $this;
	}

	public function setSummaryFallback($fb = true)
	{
		$this->_summaryFb = (bool) $fb;
		if ($fb) {
			$this->_summary = null;
		}

		return $this;
	}

	public function hasSummaryFallback()
	{
		return $this->_summaryFb;
	}

	public function getSummary()
    {
		return $this->_summary;
	}

    /**
     * Set page content, ie the body of the page
     *
     * @param  string $content
     * @return SxCms_Page
     */
	public function setContent($content)
	{
		$this->_content = $content;
		return $this;
	}

	public function setContentFallback($fb = true)
	{
		$this->_contentFb = (bool) $fb;
		if ($fb) {
			$this->_content = null;
		}

		return $this;
	}

	public function hasContentFallback()
	{
		
		return $this->_contentFb;
	}

    /**
     * Returns the content (body) of the page
     * 
     * @return string
     */
	public function getContent()
	{
		return $this->_content;
	}

    /**
     * Validates content of the page
     *
     * @todo refactor in seperate validation object
     * @return bool
     */
	public function validateContent()
	{
		if ($this->_contentFb) {
			return true;
		}

		$validator = new Zend_Validate_StringLength(2);
		if ($validator->isValid($this->_content)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
		$msg->addMessage('content', $validator->getMessages(), 'content');
		return false;
	}

    /**
     * Sets the page source
     *
     * @param  string $source
     * @return SxCms_Page
     */
	public function setSource($source)
	{
		$this->_source = $source;
		return $this;
	}

	public function setSourceFallback($fb = true)
	{
		$this->_sourceFb = $fb;
		if ($fb) {
			$this->_source = null;
		}

		return $this;
	}

	public function hasSourceFallback()
	{
		return $this->_sourceFb;
	}

    /**
     * Returns page source
     * 
     * @return bool
     */
	public function getSource()
	{
		return $this->_source;
	}

    /**
     * Validates source
     *
     * @todo refactor in seperate validation object
     * @return bool
     */
	public function validateSource()
	{
		if ($this->_sourceFb) {
			return true;
		}

		if (isset($this->_source) && !empty($this->_source)) {
			$validator = new Zend_Validate_StringLength(2);
			if (!$validator->isValid($this->_source)) {
				$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
				$msg->addMessage('source', $validator->getMessages(), 'content');

				return false;
			}
		}

		return true;
	}

	public function setLink($link)
	{
		$this->_link = $link;
		return $this;
	}

	public function setLinkFallback($fb = true)
	{
		$this->_linkFb = (bool) $fb;
		if ($fb) {
			$this->_link = null;
		}

		return $this;
	}

	public function hasLinkFallback()
	{
		return $this->_linkFb;
	}

	public function getLink()
	{
		return $this->_link;
	}

	public function validateLink()
	{
		if ($this->_linkFb) {
			return true;
		}

		$validator = new Zend_Validate_StringLength(1);
		if (!$validator->isValid($this->_link)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('link', $validator->getMessages(), 'external');

			return false;
		}

		return true;
	}

	public function setParent(SxCms_Page $page)
	{
		$this->_parent = $page;
		return $this;
	}

	public function getParent()
	{
		if (!isset($this->_parent)) {
			return new SxCms_Page();
		}

		return $this->_parent;
	}

	public function validateParent()
	{
		if ($this->_parent && $this->_parent->getId() === 0) {
			return true;
		}

		if (!isset($this->_parent)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('parent', array('required' => 'You must select a parent page'), 'menu-tags');

			return false;
		} else if ($this->_parent->getId() === $this->_id) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('parent', array('required' => 'A page cannot be a subnode of itself'), 'menu-tags');

			return false;
		}

		return true;
	}

	public function setAuthor(User_Model_User $author)
	{
		$this->_author = $author;
		return $this;
	}

	public function setLayout($layout)
	{
		$this->_layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->_layout;
	}

	public function validateLayout()
	{
		if (!isset($this->_layout) || empty($this->_layout)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('layout', array('required' => 'You must select a layout'), 'layout');

			return false;
		}

		return true;
	}

	public function setType($type)
	{
		$this->_type = (int) $type;
		return $this;
	}

	public function getType()
	{
		return $this->_type;
	}

	public function setNavigation($show = true)
	{
		$this->_navigation = (bool) $show;
		return $this;
	}

	public function isInNavigation()
	{
		return $this->_navigation;
	}

	public function setSitemap($show = true)
	{
		$this->_sitemap = (bool) $show;
		return $this;
	}

	public function isInSitemap()
	{
		return $this->_sitemap;
	}

	public function addTag($tag)
	{
		if (is_array($tag)) {
			$this->_tags = array_merge($this->_tags, $tag);
		} else {
			$this->_tags[] = $tag;
		}

		$this->_tags = array_unique($this->_tags);

		return $this;
	}

	public function getTags()
	{
		return $this->_tags;
	}

	public function setLocked($by, $date)
	{
		$this->_lockedBy = $by;
		$this->_dateLocked = $date;

		return $this;
	}

	public function isLocked()
	{
		if ($this->_lockedBy) {
			return $this->_dateLocked;
		}

		return false;
	}
	
	public function setInvisible($invisible)
	{
		$this->_invisible = (int) $invisible;
		return $this;
	}

	public function getInvisible()
	{
		return $this->_invisible;
	}
	
	public function setSeoTitle($seotitle)
	{
		$this->_seotitle = $seotitle;
		return $this;
	}

	public function getSeoTitle()
	{
		return $this->_seotitle;
	}
	
	public function setSeoTags($seotags)
	{
		$this->_seotags = $seotags;
		return $this;
	}

	public function getSeoTags()
	{
		return $this->_seotags;
	}
	
	public function setSeoDescription($seodescription)
	{
		$this->_seodescription = $seodescription;
		return $this;
	}

	public function getSeoDescription()
	{
		return $this->_seodescription;
	}

	public function setDateCreated($date)
	{
		$this->_dateCreated = $date;
		return $this;
	}

	public function getDateCreated($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->_dateCreated));
		}
		return $this->_dateCreated;
	}

	public function setDatePublished($date)
	{
		$this->_datePublished = $date;
		return $this;
	}

	public function getDatePublished($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->_datePublished));
		}
		return $this->_datePublished;
	}

	public function validateDatePublished()
	{
		$validator = new Zend_Validate_Date('YYYY/MM/DD');
		if (!$validator->isValid(substr($this->_datePublished, 0, 10))) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('date_published', $validator->getMessages(), 'publish');

			return false;
		}

		return true;
	}

	public function isExpired()
	{
		if (!$this->_dateExpired) {
			return false;
		}

		return strtotime($this->_dateExpired) < strtotime('now');
	}

	public function setDateExpired($date)
	{
		$this->_dateExpired = $date;
		return $this;
	}

	public function getDateExpired($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->_dateExpired));
		}
		return $this->_dateExpired;
	}

	public function validateDateExpired()
	{
		if (!$this->_dateExpired) {
			return true;
		}

		$validator = new Zend_Validate_Date('YYYY/MM/DD');
		if (!$validator->isValid(substr($this->_dateExpired, 0, 10))) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Page');
			$msg->addMessage('date_expired', $validator->getMessages(), 'publish');

			return false;
		}

		return true;
	}

    public function setLevel($level)
    {
        $this->level = (int) $level;
        return $this->level;
    }

    public function getLevel()
    {
        return $this->level;
    }
    
	public function setLeft($left)
	{
		$this->_left = (int) $left;
		return $this;
	}

	public function getLeft()
	{
		return $this->_left;
	}

	public function setRight($right)
	{
		$this->_right = (int) $right;
		return $this;
	}

	public function getRight()
	{
		return $this->_right;
	}

	public function isTranslation()
	{
		$config = Zend_Registry::get('config');
		return $this->_language !== $config->system->defaults->language;
	}

	public function setTranslated($translated = true)
	{
		$this->_translated = (bool) $translated;
	}

	public function setThumb($filename)
	{
		$this->_thumb = $filename;
		return $this;
	}

	public function getThumb()
	{
		return $this->_thumb;
	}

	public function addPermission(SxCms_Group $group)
	{
		$this->_permissions[$group->getId()] = $group;
		return $this;
	}

	public function getPermissions()
	{
		return $this->_permissions;
	}

	public function clearPermissions()
	{
		$this->_permissions = array();
		return $this;
	}

	public function setAllowComments($bool = true)
	{
		$this->_comments = $bool;
		return $this;
	}

	public function allowComments()
	{
		return $this->_comments;
	}

    public function isAllowed($identity)
    {
    	if (!$this->getPermissions()) {
    		return true;
    	}

        if (!$identity) {
            return !$this->getPermissions();
        }

        foreach ($identity->getGroups() as $group) {
            if (isset($this->_permissions[$group->getId()])) {
                return true;
            }
        }

        return false;
    }

    public function addChild(SxCms_Page $page)
    {
        $this->children[$page->getId()] = $page;
        return $this;
    }

    public function getChildren()
    {
        $mapper = new SxCms_Page_TreeMapper();
        $mapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

        $order = $mapper->getChildOrder($this->getId());
        $sorted = array();
        foreach ($order as $id) {
            if (isset($this->children[$id])) {
                $sorted[$id] = $this->children[$id];
            }
        }

        $this->children = $sorted;
        return $this->children;
    }
	
	public function hasChildren()
    {
        $mapper = new SxCms_Page_TreeMapper();
        $mapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

        $order = $mapper->getChildOrder($this->getId());
       
	   if(count($order) > 0) {
		 	return true;   
	   }
        return false;
    }

    public function addRevision(SxCms_Page_Revision $rev)
    {
        $this->revisions[$rev->getId()] = $rev;
        return $this;
    }

    public function getRevisions()
    {
        return $this->revisions;
    }

    public function setActive($active = true)
    {
        $this->active = (bool) $active;
        return $this;
    }

    public function isActive()
    {
        return $this->active;
    }
    
	public function isValid()
	{
		switch ($this->_type) {
			case self::EXTERNAL:
				$this->validateTitle();
				$this->validateParent();
				$this->validateLink();
				$this->validateDateExpired();
				$this->validateDatePublished();
				break;
			case self::SUMMARY:
				$this->validateTitle();
				$this->validateParent();
				$this->validateDateExpired();
				$this->validateDatePublished();
				break;
			case self::INTERNAL:
				$this->validateTitle();
				$this->validateSource();
				$this->validateContent();
				$this->validateParent();
				$this->validateDateExpired();
				$this->validateDatePublished();
			case self::ARTICLE:
				$this->validateTitle();
				$this->validateSource();
				$this->validateContent();
				$this->validateDateExpired();
				$this->validateDatePublished();
				break;
		}

		return count(Sanmax_MessageStack::getInstance('SxCms_Page')
				->getNamespaceMessages()) == 0;
	}

	public function loadState($state = self::STATE_LIVE)
	{
		$db = Zend_Registry::get('db');
		if ($state === self::STATE_REVISION) {
			$select = $db->select()
				->from(array('p' => 'Page'), array('*'))
				->join(array('t' => 'PageRev'), 'p.page_id = t.page_id')
				->where('p.page_id = ?', $this->_id)
				->where('t.language = ?', $this->getLanguage())
				->order('t.revision_id ASC');

			$stmt = $db->query($select);
			$result = $stmt->fetchAll();
		}

		if ($state === self::STATE_LIVE or !$result) {
			$select = $db->select()
				->from(array('p' => 'Page'), array('*'))
				->joinLeft(array('t' => 'PageTsl'), 'p.page_id = t.page_id')
				->where('p.page_id = ?', $this->_id)
				->where('t.language = ?', $this->getLanguage());

			$stmt = $db->query($select);
			$result = $stmt->fetchAll();
		}

		$pageMapper = new SxCms_Page_DataMapper();
		foreach ($result as $page) {
			$pageMapper->map($page, $this);
		}

		$select = $db->select()
			->from('PageAcl', array('*'))
			->where('page_id = ?', $this->_id);

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$group = new SxCms_Group();
			$group->setId($row['group_id']);

			$this->addPermission($group);
		}

		return $this;
	}

	public function getBreadcrumbs($language = 'nl', $skipRoot = false, $string = true)
	{
		if (false === $this->getParent()->getId()) {
			if ($string) {
				return '';
			}

			return array();
		}

		$cacheId = 'getBreadcrumbs_' . (int) $this->getId() . (int) $this->getParent()->getId() .
		$language . (int) $skipRoot . (int) $string;

		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			return $result;
		}

		$path = $this->getXmlMapper()
			->getPath($this->getParent()->getId());

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Page', array())
			->joinLeft(array('t' => 'PageTsl'), 'Page.page_id = t.page_id', array())
			->columns('t.title')
			->columns('Page.page_id')
			->where('Page.page_id IN (?)', $path)
			->where('t.language = ?',  $language)
			->order('Page.parent_id');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		if ($skipRoot) {
			array_shift($result);
		}

		if (!$string) {
			$result[] = array(
				'title' => $this->_title,
				'page_id' => $this->_id,
			);

			$cache->save($result, $cacheId, array('SxCms_Page'));
			return $result;
		}

		$bcrumb = '';
		foreach ($result as $page) {
			$bcrumb .= $page['title'] . ' > ';
		}

		$cache->save($bcrumb, $cacheId, array('SxCms_Page'));
		return $bcrumb;
	}

	public function save()
	{
		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_ALL);

		$db = Zend_Registry::get('db');
		if ($this->getType() == self::EXTERNAL) {
			$this->setLayout(null)
				 ->setSource(null)
				 ->setContent(null);
		}

		if ($this->getType() == self::ARTICLE) {
			$this->setLayout('default');
		}

		$identity = Zend_Auth::getInstance()->getIdentity();
		$pageData = array(
			'parent_id'		 => (int) $this->getParent()->getId(),
			'author_id' 	 => $identity->getId(),
			'layout'	 	 => $this->getLayout(),
			'navigation'	 => (int) $this->isInNavigation(),
			'type'		     => (int) $this->getType(),
			'sitemap'	 	 => (int) $this->isInSitemap(),
		    'comments'       => (int) $this->allowComments(),
			'locked_by'      => 0,
			'date_locked'    => '0000-00-00 00:00:00',
			'date_published' => $this->getDatePublished(),
			'date_expired'   => $this->getDateExpired(),
			'date_updated'   => new Zend_Db_Expr('NOW()'),
		
		);

	
		if (null !== $this->getThumb()) {
			$pageData['thumb'] = $this->getThumb();
		}

		if ($this->getId() !== false) { // strict checking, ID can be 0 (homepage)
			$db->delete('PageAcl', 'page_id = ' . $this->getId());
			foreach ($this->_permissions as $group) {
				$gData = array(
					'page_id' => $this->_id,
					'group_id' => $group->getId(),
				);

				$db->insert('PageAcl', $gData);
			}

			$orig = new SxCms_Page();
			$orig->setId($this->getId())->loadState();

			$x = $orig->getParent()->getId() !== $this->getParent()->getId();
			if ($x or ($this->getLeft() xor $this->getRight())) {
				if ($this->getType() != self::ARTICLE) {
					$this->getXmlMapper()
					->move(
						$this->getId(),
						$this->getParent()->getId(),
						$this->getLeft(),
						$this->getLeft() ? true : false
					)
					->save();
				}
			}
			
			

			if ($this->getType() != self::EXTERNAL && $this->_id != 0) {
				$this->setLink($this->_createUrl($this->getLanguage()));
			}
		
			
			return $db->update('Page', $pageData, 'page_id = ' . $this->_id);
		}

		$pageData['date_created'] = new Zend_Db_Expr('NOW()');
		$db->insert('Page', $pageData);
		$this->setId($db->lastInsertId());

		foreach ($this->_permissions as $group) {
			$gData = array(
				'page_id' => $this->_id,
				'group_id' => $group->getId(),
			);

			$db->insert('PageAcl', $gData);
		}

		if ($this->getType() != self::ARTICLE) {
			$this->getXmlMapper()->add(
				$this->getId(),
				$this->getParent()->getId(),
				$this->_cleanTitle($this->getTitle()),
				$this->getLeft(),
				$this->getLeft() ? true : false
			)->save();
		}

		$this->publish();
		return true;
	}

	public function delete()
	{
		$cache = Zend_Registry::get('cache');
		$cache->clean(
			Zend_Cache::CLEANING_MODE_MATCHING_TAG,
			array('SxCms_Page')
		);

		if ($this->getType() !== self::ARTICLE) {
			$this->getXmlMapper()
				->delete($this->getId())
				->save();
		}

		$db = Zend_Registry::get('db');
		$db->delete('PageTsl', 'page_id = ' . $this->getId());
		$db->delete('PageRev', 'page_id = ' . $this->getId());

		return $db->delete('Page', 'page_id = ' . $this->getId());
	}

	public function publish()
	{
		$cache = Zend_Registry::get('cache');
		$cache->clean(
			Zend_Cache::CLEANING_MODE_MATCHING_TAG,
			array('SxCms_Page')
		);

		$db = Zend_Registry::get('db');
		$query = $db->select()
			->from('PageTsl', 'COUNT(*)')
			->where('page_id = ?', $this->_id)
			->where('language = ?', $this->getLanguage());

		if ($this->getType() !== self::EXTERNAL && $this->_id != 0) {
			$this->setLink($this->_createUrl($this->getLanguage()));
		}

		$url = $this->getLink();
		$tslData = array(
			'page_id'	 	=> $this->_id,
			'language'   	=> $this->getLanguage(),
			'title'		 	=> stripslashes($this->getTitle()),
			'title_fb'   	=> (int) $this->hasTitleFallback(),
			'summary'	 	=> stripslashes($this->getSummary()),
			'summary_fb'	=> (int) $this->hasSummaryFallback(),
			'content'   	=> stripslashes($this->getContent()),
			'content_fb' 	=> (int) $this->hasContentFallback(),
			'source'	 	=> stripslashes($this->getSource()),
			'source_fb'  	=> (int) $this->hasSourceFallback(),
			'link'		 	=> $url,
			'link_fb'    	=> (int) $this->hasLinkFallback(),
            'final'      	=> 0,
			'invisible'  	=> (int) $this->getInvisible(),
			'seotitle'	 	=> $this->getSeoTitle(),
			'seotags'	 	=> $this->getSeoTags(),
			'seodescription' => $this->getSeoDescription()
		);
        
        if ($db->fetchOne($query)) {
            if (!$this->isTranslated()) {
                $db->update('PageTsl', array('final' => 1), 'page_id = ' . $this->_id . ' AND language != \'nl\'');
            }

			$db->update('PageTsl', $tslData,
				'page_id = ' . $this->_id .
				' AND language = \'' . $this->getLanguage() . '\'');
		} else {
			$config = Zend_Registry::get('config');
			foreach ($config->system->language as $lng => $slng) {
				if ($this->getType() == self::INTERNAL) {
					$url = $this->_createUrl($this->getLanguage());
					$this->setLink($url);
				} else {
					$url = $this->getLink();
				}

                $tslDate['final']    = 1;
				$tslData['link']     = $url;
				$tslData['language'] = $lng;
				
				$db->insert('PageTsl', $tslData);
			}
		}

		return true;
	}

	public function lock()
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
		$date = date('Y-m-d H:i:s');
		$this->setLocked($identity, $date);

		$data = array(
			'locked_by'   => $identity->getId(),
			'date_locked' => $date
		);

		$db = Zend_Registry::get('db');
		$db->update('Page', $data, 'page_id = ' . $this->_id);

		return true;
	}

	public function unlock()
	{
		if (null === $this->_id or $this->_id === false) {
			return true;
		}

		$data = array(
			'locked_by'   => 0,
			'date_locked' => '0000-00-00 00:00:00'
		);

		$db = Zend_Registry::get('db');
		$db->update('Page', $data, 'page_id = ' . $this->_id);

		return true;
	}

    public function createUrl()
    {
        return $this->_createUrl($this->getLanguage());
    }

	protected function _createUrl($language, $skip = false)
	{
		$url = strtolower($this->getBreadcrumbs($language, true));
		if (!$skip) {
            $url .= str_replace('/', '-', $this->getTitle());
        }

		$url = preg_replace('%>%', '/', $url);
		$url = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $url);
		$url = preg_replace('%-{2,}%', '-', $url);
		$url = preg_replace('%/{2,}%', '/', $url);
		$url = preg_replace('%(-*)/(-*)%', '/', $url);

		$url = trim($url, '/');
		$url = trim($url, '-');

		return strtolower($url);
	}

	protected function _cleanTitle($title){
		$title = preg_replace('%>%', '/', $title);
        $title = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $title);
        $title = preg_replace('%-{2,}%', '-', $title);
        $title = preg_replace('%/{2,}%', '/', $title);
        $title = preg_replace('%(-*)/(-*)%', '/', $title);

        $title = trim($title, '/');
        $title = trim($title, '-');

		return strtolower($title);
	}
}
