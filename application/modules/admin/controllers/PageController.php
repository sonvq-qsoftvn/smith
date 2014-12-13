<?php

class Admin_PageController extends Zend_Controller_Action
{
	/**
	 * Holds a reference to the current page object
	 *
	 * @var SxCms_Page
	 */
	protected $_page;

	public function init()
	{
		$system = new Zend_Session_Namespace('System');
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		if (!isset($wizard->page)) {
			$wizard->page = new SxCms_Page();
			$wizard->page->setLanguage($system->lng);
		}

		$this->_page = $wizard->page;
		$this->view->menu = array(
			'template' => 'page/__menu.phtml',
			'active'   => 'menu-page',
			'tab'      => 'cms',
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/page.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $this->adminlngs = $config->systemadmin->language;
	}

	public function initializeAction()
	{
		$pageId = (int) $this->_getParam('id');
		$this->_page->setId($pageId)
			->loadState(SxCms_Page::STATE_REVISION)
			->lock();
			

		$goto = str_replace('.', '/', $this->_getParam('go'));
		$this->_redirect($goto);
	}

	public function initializeRevisionAction()
	{
		$revision = new SxCms_Page_Revision();
		$revision->setId($this->_getParam('id'))
			->loadState();

		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$wizard->revision = $revision;

		$goto = str_replace('.', '/', $this->_getParam('go'));
		$this->_helper->redirector->setGotoUrl($goto);
	}

	public function indexAction()
	{
		SxCms_Acl::requireAcl('page', 'page.index');
		
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');

		$system = new Zend_Session_Namespace('System');
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		if (isset($wizard->page)) {
			$wizard->page->unlock();
			unset($wizard->page);
		}

		$pageProxy = new SxCms_Page_Proxy();
		$xmlMapper = new SxCms_Page_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

		$sorted = $xmlMapper->map($pageProxy->getSiteTree($system->lng));
		$this->view->siteTree  = $sorted;
		$this->view->xmlMapper = $xmlMapper;
		
	}

	public function newsAction()
	{
		SxCms_Acl::requireAcl('news', 'news.index');

		$system = new Zend_Session_Namespace('System');

		$pageProxy = new SxCms_Page_Proxy();
		$articles  = $pageProxy->getSiteTree($system->lng, true);

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($articles));
		$paginator->setCurrentPageNumber($this->_getParam('page'))
			->setItemCountPerPage(15);

		$this->view->type = SxCms_Page::ARTICLE;
        $this->view->siteTree  = $articles;
		$this->view->paginator = $paginator;
	}

	public function addNewsAction()
	{
		SxCms_Acl::requireAcl('news', 'news.add');

		$system = new Zend_Session_Namespace('System');
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');

		$wizard->page = new SxCms_Page();
		$wizard->page->setLanguage($system->lng);
		$wizard->page->setType(SxCms_Page::ARTICLE);

		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$wizard->page = $wizard->page;

		$this->_helper->redirector->gotoSimple('add', 'page');
	}

	public function addAction()
	{
		SxCms_Acl::requireAcl('page', 'page.add');

		$system = new Zend_Session_Namespace('System');
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
	
		if ($this->_getParam('reset')) {
			$wizard->page = new SxCms_Page();
			$wizard->page->setLanguage($system->lng);
			$this->_helper->redirector->gotoSimple('wizard-type', 'page');
		}
		
		$mapper = new SxCms_Group_DataMapper();
		$this->view->groups = $mapper->getAll();

		$revision = new SxCms_Page_Revision();
		$revision->setApproved(true);
		$revision->setNotes($this->admin_tmx->_('newpagecreated'));

		if ($wizard->page->getId() !== false) {
			$revision->setApproved(false);
			$revision->setNotes($this->admin_tmx->_('pageedited'));
		}

		if ($this->getRequest()->isPost()) {
			
			$path = APPLICATION_ROOT . '/public_html/images/thumbs/70X90/';
			$system->lng = $this->_getParam('lang');
			$adapter = new Zend_File_Transfer_Adapter_Http();
			$adapter->setDestination($path);
			$adapter->setOptions(array('ignoreNoFile' => true));

			if (!$adapter->receive()) {
				$msgr = Sanmax_MessageStack::getInstance('SxCms_Page');
				$msgr->addMessage('file', $adapter->getMessages(), 'title');
			}

			$wizard->page->setThumb(null);
			$files = $adapter->getFileInfo();
			foreach ($files as $file) {
				if (!$file['tmp_name']) {
					continue;
				}

				$image = new Imagick($file['tmp_name']);
				$image->cropThumbnailImage(70, 90);

				$filename = uniqid() . '.jpg';
				$image->setCompression(Imagick::COMPRESSION_JPEG);
				$image->setImageFormat('jpeg');
				$image->writeImage($path . $filename);
				$image->clear();
				$image->destroy();

				unlink($file['tmp_name']);

				$wizard->page->setThumb($filename);
			}

			$wizard->page->clearPermissions();
			foreach ((array) $this->_getParam('group') as $groupId) {
				$group = new SxCms_Group();
				$group->setId($groupId);

				$wizard->page->addPermission($group);
			}

			$wizard->page->setTitle($this->_getParam('title'))
				 ->setTitleFallback($this->_getParam('title_fb'))
				 ->setSummary($this->_getParam('summary'))
				 ->setSummaryFallback($this->_getParam('summary_fb'))
				 ->setContent($this->_getParam('contenti'))
				 ->setContentFallback($this->_getParam('content_fb'))
				 ->setSource($this->_getParam('source'))
				 ->setSourceFallback($this->_getParam('source_fb'))
				 ->setLayout($this->_getParam('layout', 'default'))
				 ->addTag(explode("\n", $this->_getParam('tags')))
				 ->setLink($this->_getParam('link'))
				 ->setNavigation($this->_getParam('menu'), false)
				 ->setSitemap($this->_getParam('sitemap'), false)
				 ->setAllowComments($this->_getParam('comments'), false)
				 ->setInvisible($this->_getParam('invisible'))
				 ->setSeoTitle($this->_getParam('seotitle'))
				 ->setSeoTags($this->_getParam('seotags'))
				 ->setSeoDescription($this->_getParam('seodescription'));

			$revision->setNotes($this->_getParam('notes'));

			$datePublished =  $this->_getParam('date_published')
				. ' ' . $this->_getParam('publish_h')
				. ':' . $this->_getParam('publish_i') . ':00';

			$dateExpired = null;
			if ($this->_getParam('date_expired')) {
				$dateExpired =  $this->_getParam('date_expired')
				. ' ' . $this->_getParam('expire_h')
				. ':' . $this->_getParam('expire_i') . ':00';
			}

			$wizard->page->setDatePublished($datePublished)
				->setDateExpired($dateExpired);

            if ($this->_getParam('translation')) {
                $wizard->page->markTranslationInvalid();
            }

			if ($wizard->page->isValid()) {
				$config = Zend_Registry::get('config');
				if ($wizard->page->getId() === false) {
					$lngs = $config->system->language;
				} else {
					$lngs[$wizard->page->getLanguage()] = null;
				}

				$wizard->page->save();

				
				foreach ($lngs as $lng => $slng) {
					$revision->setNotes($this->_getParam('notes'))
						->setLanguage($lng)
						->setTitle($wizard->page->getTitle())
						->setTitleFallback($wizard->page->hasTitleFallback())
						->setSummary($wizard->page->getSummary())
						->setSummaryFallback($wizard->page->hasSummaryFallback())
						->setContent($wizard->page->getContent())
						->setContentFallback($wizard->page->hasContentFallback())
						->setSource($wizard->page->getSource())
						->setSourceFallback($wizard->page->hasSourceFallback())
						->setLink($wizard->page->getLink())
						->setLinkFallback($wizard->page->hasLinkFallback())
						->setPageId($wizard->page->getId())
						->setInvisible($wizard->page->getInvisible());
					$revision->setSeoTitle($wizard->page->getSeoTitle())
						->setSeoTags($wizard->page->getSeoTags())
						->setSeoDescription($wizard->page->getSeoDescription());
		
				$revision->save();

					if (!$this->_getParam('revision')) {
						$revision->approve();
					}
				}

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('pagesavesuccess'));

				if ($wizard->page->getType() == SxCms_Page::ARTICLE) {
					$this->_helper->redirector->gotoSimple('news', 'page');
				} else {
					$this->_helper->redirector->gotoSimple('index', 'page');
				}

				$wizard->unsetAll();
			}

			$wizard->page->setDatePublished($this->_getParam('date_published'))
				 ->setDateExpired($this->_getParam('date_expired'));
		}

		$this->view->page     = $wizard->page;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Page');
		$this->view->revision = $revision;
	}

	public function quickEditAction()
	{
		SxCms_Acl::requireAcl('page', 'page.edit');

		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		if ($wizard->page->getId() === false) {
			$this->_helper->redirector->gotoSimple('index', 'page');
		}

		$wizard->page->setLanguage($this->_getParam('lng'))
			->loadState(SxCms_Page::STATE_REVISION);
		
		$this->_helper->redirector->gotoSimple('add', 'page');
	}

	public function deleteAction()
	{
		SxCms_Acl::requireAcl('page', 'page.delete');

		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$type = $wizard->page->getType();

		if ($wizard->page->getId() !== false) {
			$wizard->page->delete();

			$flashMessenger = $this->_helper->getHelper('FlashMessenger');
			$flashMessenger->addMessage($this->admin_tmx->_('pagedeletesuccess'));
		}

		$action = $type == SxCms_Page::ARTICLE ? 'news' : 'index';
		$this->_helper->redirector->gotoSimple($action, 'page');
	}

	public function setParentAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$system = new Zend_Session_Namespace('System');

		$parentPage = new SxCms_Page();
		$parentPage->setId($this->_getParam('page'))
			->loadState();

		$wizard->page->setParent($parentPage);

		$pageProxy = new SxCms_Page_Proxy();

		if ($pageProxy->getPagesByParentId($parentPage->getId(), null, $system->lng)) {
			$this->_helper->redirector->gotoSimple('wizard-position', 'page');
		} else {
			$this->_helper->redirector->gotoSimple('wizard-close', 'page');
		}

		$this->view->page = $wizard->page;
	}

	public function setPositionAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		if ($this->_getParam('left')) {
			$wizard->page->setLeft($this->_getParam('left'));
            $wizard->page->setRight(null);
		} else if ($this->_getParam('right')) {
			$wizard->page->setRight($this->_getParam('right'));
            $wizard->page->setLeft(null);
		}

		$this->_helper->redirector->gotoSimple('wizard-close', 'page');
	}

	public function wizardPositionAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$system = new Zend_Session_Namespace('System');

		$pageProxy = new SxCms_Page_Proxy();

		$pages = $pageProxy->getPagesByParentId($wizard->page->getParent()->getId(), null, $system->lng);
		if (!$pages) {
			$this->_helper->redirector->gotoSimple('wizard-menu-tags', 'page');
		}

		$this->view->pages = $pages;
		$this->_helper->layout->setLayout('nolayout');
	}

	public function wizardTypeAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		if ($this->getRequest()->isPost()) {
			$wizard->page->setType($this->_getParam('type'));

			$this->_helper->redirector->gotoSimple('add', 'page');
		}

		$this->view->page = $wizard->page;
	}

	public function wizardParentPageAction()
	{
		$system = new Zend_Session_Namespace('System');

		$proxy = new SxCms_Page_Proxy();
		$tree = $proxy->getSiteTreeHtml($system->lng, '/admin/page/set-parent/page/%id%');

		$this->_page->getBreadcrumbs($system->lng);
		$this->view->siteTree = $tree;

		$pageProxy = new SxCms_Page_Proxy();
		$xmlMapper = new SxCms_Page_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

		$sorted = $xmlMapper->map($pageProxy->getSiteTree($system->lng));
		$this->view->siteTree  = $sorted;
		$this->view->xmlMapper = $xmlMapper;
		$this->view->page      = $this->_page;

		$this->_helper->layout->setLayout('nolayout');
	}

	public function wizardNotesAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$this->view->page = $wizard->page;

		$notes = '';
		$revision = new SxCms_Page_Revision();
		if ($wizard->page->getId() === false) {
			$notes = $this->admin_tmx->_('newpagecreated');
			$revision->setApproved(true);
		}

		$revision->setNotes($notes);
		if ($this->getRequest()->isPost() or isset($wizard->settings)) {
			$lng = $wizard->page->getLanguage();
			$wizard->page->save();

			if (isset($wizard->settings)) {
				$wizard->unsetAll();
				$this->_helper->redirector->gotoSimple('wizard-done', 'page');
			}

			if ($wizard->page->getId() === false) {
				$config = Zend_Registry::get('config');
				foreach ($config->system->language as $lng => $slng) {
					$revision->setNotes($this->_getParam('notes'))
						->setLanguage($lng)
						->setTitle($wizard->page->getTitle())
						->setTitleFallback($wizard->page->hasTitleFallback())
						->setSummary($wizard->page->getSummary())
						->setSummaryFallback($wizard->page->hasSummaryFallback())
						->setContent($wizard->page->getContent())
						->setContentFallback($wizard->page->hasContentFallback())
						->setSource($wizard->page->getSource())
						->setSourceFallback($wizard->page->hasSourceFallback())
						->setLink($wizard->page->getLink())
						->setLinkFallback($wizard->page->hasLinkFallback())
						->setPageId($wizard->page->getId())
						->setInvisible($wizard->page->getInvisible())
						->setSeoTitle($wizard->page->getSeoTitle())
						->setSeoTags($wizard->page->getSeoTags())
						->setSeoDescription($wizard->page->getSeoDescription())
						->save();

					if (!$this->_getParam('revision')) {
						$revision->setApproved(true);
					}

					if (!$revision->isApproved()) {
						$revision->warnLiveVersion();
					} else {
						$revision->approve();
					}
				}
			} else {
				$revision->setNotes($this->_getParam('notes'))
					->setLanguage($lng)
					->setTitle($wizard->page->getTitle())
					->setTitleFallback($wizard->page->hasTitleFallback())
					->setSummary($wizard->page->getSummary())
					->setSummaryFallback($wizard->page->hasSummaryFallback())
					->setContent($wizard->page->getContent())
					->setContentFallback($wizard->page->hasContentFallback())
					->setSource($wizard->page->getSource())
					->setSourceFallback($wizard->page->hasSourceFallback())
					->setLink($wizard->page->getLink())
					->setLinkFallback($wizard->page->hasLinkFallback())
					->setPageId($wizard->page->getId())
					->setInvisible($wizard->page->getInvisible())
					->setSeoTitle($wizard->page->getSeoTitle())
					->setSeoTags($wizard->page->getSeoTags())
					->setSeoDescription($wizard->page->getSeoDescription())
					->save();

				if (!$this->_getParam('revision')) {
					$revision->setApproved(true);
				}

				if (!$revision->isApproved()) {
					$revision->warnLiveVersion();
				} else {
					$revision->approve();
				}
			}

			$wizard->unsetAll();
			$this->_helper->redirector->gotoSimple('wizard-done', 'page');
		}

		$this->view->revision = $revision;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Page');
	}

	public function wizardDoneAction()
	{
	}

	public function wizardCloseAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');

		$this->view->page = $wizard->page;
		$this->_helper->layout->setLayout('nolayout');
	}

	public function revisionsAction()
	{
		SxCms_Acl::requireAcl('page', 'page.revision.index');

		$wizard = new Zend_Session_Namespace('Cms_PageWizard');
		$system = new Zend_Session_Namespace('System');

		$pageProxy = new SxCms_Page_Proxy();
		$revisions = $pageProxy->getPageRevisions($wizard->page->getId(), $system->lng);

		$wizard->page->setLanguage($this->_getParam('lng'));
		$this->view->revisions = $revisions;
		$this->view->page = $wizard->page;
	}

	public function revisionAction()
	{
		$wizard = new Zend_Session_Namespace('Cms_PageWizard');

		if ($this->getRequest()->isGet()) {
			$revision = $wizard->revision;

			$page = new SxCms_Page();
			$page->setId($revision->getPageId())
				->setLanguage($revision->getLanguage())
				->loadState();

			$this->view->diff = $revision->getDiffObject($page);
		}

		if ($this->getRequest()->isPost()) {
			$revision = $wizard->revision;
			$revision->approve();

			$this->_helper->redirector->setGotoUrl('/admin/page/revisions/lng/' . $revision->getLanguage());
		}
	}

	public function commentsAction()
	{
		SxCms_Acl::requireAcl('news', 'news.comments');

		$mapper = new SxCms_Comment_DataMapper();
		if ($this->_getParam('type')) {
			$comments = $mapper->getComments();
		} else {
			$comments = $mapper->getCommentsToApprove();
		}

		$this->view->comments = $comments;
	}

	public function commentEditAction()
	{
		SxCms_Acl::requireAcl('news', 'news.comments.edit');

		$mapper  = new SxCms_Comment_DataMapper();
		$comment = $mapper->getById($this->_getParam('id'));

		if ($this->getRequest()->isPost()) {
			$author = $comment->getCommenter();
			$author->setName($this->_getParam('name'))
				->setEmail($this->_getParam('email'))
				->setWebsite($this->_getParam('website'));

			$comment->setMessage($this->_getParam('message'))
				->setApproved($this->_getParam('approved'));

			if ($comment->isApproved() && !$comment->getDateApproved()) {
				$comment->setDateApproved(date('Y-m-d H:i:s'));
			}

			$validator = new SxCms_Comment_UpdateValidator();
			if ($validator->validate($comment)) {
				$mapper->save($comment);

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('messageeditedsuccess'));

				$this->_helper->redirector->gotoSimple('comments', 'page');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Comments');
		$this->view->comment = $comment;
	}

	public function commentDeleteAction()
	{
		SxCms_Acl::requireAcl('news', 'news.comments.delete');

		$comment = new SxCms_Comment();
		$comment->setId($this->_getParam('id'));

		$mapper = new SxCms_Comment_DataMapper();
		$mapper->delete($comment);

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('messagedeletedsuccess'));

		$this->_helper->redirector->gotoSimple('comments', 'page');
	}

	public function tinymceLinkAction()
	{
		$this->_helper->layout->setLayout('nolayout');
		$system = new Zend_Session_Namespace('System');

		$pageProxy = new SxCms_Page_Proxy();
		$xmlMapper = new SxCms_Page_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/navigation.xml');

		$sorted = $xmlMapper->map($pageProxy->getSiteTree($system->lng));
		$this->view->siteTree  = $sorted;
		$this->view->xmlMapper = $xmlMapper;
		$this->view->lng       = $system->lng;
	}

    public function getUrlAjaxAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $this->_page->setTitle($this->_getParam('title'));

        $system = new Zend_Session_Namespace('System');
        $link = $this->_page->createUrl();

        $router = Zend_Controller_Front::getInstance()->getRouter();
        if ($this->_page->getType() == SxCms_Page::ARTICLE) {
			$link = $router->assemble(array('url' => $link, 'lng' => $system->lng), 'news-article');
        } else {
			$link = $router->assemble(array('url' => $link, 'lng' => $system->lng), 'content');
        }

        echo urldecode($link);
    }

    public function deleteThumbnailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $page = new SxCms_Page();
        $page->setId($this->_getParam('page'));
        $page->loadState();

        $filename = base64_decode($this->_getParam('filename'));
        $path = APPLICATION_ROOT . '/public_html/images/thumbs/70X90/';
        unlink($path . $filename);

        $page->setThumb('');
        $page->save();
    }

    public function previewAction()
    {
    	SxCms_Acl::requireAcl('page', 'page.preview');

		$pageId = (int) $this->_getParam('id');

		$page = new SxCms_Page();
		$page->setId($pageId)
			->loadState(SxCms_Page::STATE_LIVE);

		$this->_helper->actionStack('content', 'index', 'default', array('url' => $page->getLink()));
    }

    public function previewRevisionAction()
    {
    	SxCms_Acl::requireAcl('page', 'page.revision.preview');

    	$system = new Zend_Session_Namespace('System');
    	$revisionId = (int) $this->_getParam('id');

		$mvc = Zend_Layout::getMvcInstance();
		$mvc->getView()
			->setScriptPath(APPLICATION_PATH . '/modules/default/views/scripts');

    	$proxy = new SxCms_Page_Proxy();
    	$page = $proxy->getPageByRevisionId($revisionId, $system->lng);

		$this->view->page = $page;

		$this->_helper->layout->setLayoutPath(APPLICATION_PATH . '/modules/default/views/scripts');
		$this->_helper->layout->setLayout($page->getLayout());

   		if ($page->getType() == SxCms_Page::SUMMARY) {
			$children = $proxy->getPagesByParentId($page->getId(), null, $system->lng, true);
			$this->view->children = $children;

			$this->renderScript('index/summary.phtml');
			return;
		}

		$this->renderScript('index/content.phtml');
    }

    public function setFilterAction()
    {
        $this->_helper->redirector->gotoSimple($this->_getParam('pfilter', 'page'), null, null, array('type' => $this->_getParam('type')));
    }

    public function reportExpiredAction()
    {
        $system = new Zend_Session_Namespace('System');

        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getExpired($system->lng, $this->_getParam('type'));

        $this->view->siteTree = $pages;
        $this->render('index');
    }

    public function reportNearlyExpiredAction()
    {
        $system = new Zend_Session_Namespace('System');
        
        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getNearlyExpired(10, $system->lng, $this->_getParam('type'));

        $this->view->siteTree = $pages;
        $this->render('index');
    }

    public function reportRevisionsAction()
    {
        $system = new Zend_Session_Namespace('System');

        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getAll($system->lng);

        $result = array();
        foreach ($pages as $id => $page) {
            $revisions = $page->getRevisions();
            $lastRev   = array_shift($revisions);
		
            if ($lastRev && !$lastRev->isApproved()) {
				if ($this->_getParam('type') && $page->getType() != $this->_getParam('type'))
					continue;
					
                $result[$id] = $page;
            }
        }

        $this->view->siteTree = $result;
        $this->render('index');
    }

    public function reportNotPublishedAction()
    {
        $system = new Zend_Session_Namespace('System');

        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getExpired($system->lng, $this->_getParam('type'));

        $this->view->siteTree = $pages;
        $this->render('index');
    }
	
	public function reportNotActiveAction()
    {
        $system = new Zend_Session_Namespace('System');

        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getNotActive($system->lng, $this->_getParam('type'));

        $this->view->siteTree = $pages;
        $this->render('index');
    }

    public function reportTranslationRequiredAction()
    {
        $system = new Zend_Session_Namespace('System');

        $proxy = new SxCms_Page_Proxy();
        $pages = $proxy->getTranslationRequired($system->lng, $this->_getParam('type'));

        $this->view->siteTree = $pages;
        $this->render('index');
    }
}
