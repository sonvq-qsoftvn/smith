<?php

class IndexController extends Zend_Controller_Action
{
    public function init() {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
		
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']); 
    }

    public function unauthorizedAction() {
        $this->getResponse()->setHttpResponseCode(401);
        $this->_helper->layout->setLayout('full');
    }

	public function contentAction() {
		$this->view->messages = $this->_helper->flashMessenger->getMessages();

		$url   = $this->_getParam('url');
		$proxy = new SxCms_Page_Proxy();
		$page  = $proxy->getPageByUrl($url, null, $this->_getParam('lng', 'en'));
		if ($page->getId() === false) {
			throw new Zend_Controller_Action_Exception('Page not found', 404);
		}

        $identity = Zend_Auth::getInstance()->getIdentity();
        if (!$page->isAllowed($identity)) {
            $this->_forward('unauthorized', 'index', null, array('url' => $this->view->url()));
            return;
        }

        if ($page->isExpired()) {
            throw new Zend_Controller_Action_Exception('Page expired', 404);
        }
		
		
		if ($page->getInvisible()) {
            throw new Zend_Controller_Action_Exception('Page expired', 404);
        }
		
		/** Gebruik Nederlandse vertaling indien nodig **/
		if ($page->hasContentFallback()) {
			$pageFallback  = $proxy->getPageById($page->getId(), 'nl');
			$page->setContent($pageFallback->getContent());
		} 
		
		$this->view->page = $page;
		$this->_helper->layout->setLayout($page->getLayout());

		if ($page->getType() == SxCms_Page::SUMMARY) {
			$children = $proxy->getPagesByParentId($page->getId(), null, $this->_getParam('lng', 'en'), true, true);
			$childrenArr = array();
			foreach ($children as $child) {
				$pageFallback = false;
				if ($child->hasSummaryFallback()) {
					$pageFallback  = $proxy->getPageById($child->getId(), 'nl');
					$child->setSummary($pageFallback->getSummary());
				} 
				array_push($childrenArr, $child);
			}
			$this->view->children = $childrenArr;

			$this->renderScript('index/summary.phtml');
			return;
		}

		if ($page->getType() == SxCms_Page::ARTICLE) {
			$this->view->comment = new SxCms_Comment();

			$captchaSession = new Zend_Session_Namespace('captcha');
			$captchaSession->setExpirationHops(3);
			if ($captchaSession->token) {
				$captcha = $captchaSession->token;
			} else {
				$captcha = new Zend_Captcha_Image();
				$captcha->setName('captcha')
					->setWordLen(6)
		            ->setDotNoiseLevel(20)
		            ->setLineNoiseLevel(0)
					->setFont(APPLICATION_PATH . '/var/fonts/BRLNSR.TTF')
					->setImgDir(APPLICATION_ROOT . '/public_html/images/captcha');

				$captcha->generate();
				$captchaSession->token = $captcha;
			}

			$this->view->captcha = $captcha;
		}

		if ($this->getRequest()->isPost() && $this->_getParam('comment-submit')) {
			$this->view->errors = array();

			$validator = new SxCms_Comment_BaseValidator();
			$validator->setCaptcha($captcha)
				->setUserCaptcha($this->_getParam('captcha'));

			$comment = new SxCms_Comment();
			$comment->setMessage($this->_getParam('message'));

			$author = new SxCms_Comment_Author();
			$author->setName($this->_getParam('name'))
				->setEmail($this->_getParam('email'))
				->setWebsite($this->_getParam('website'));

			$comment->setPage($page);
			$comment->setCommenter($author);

			if (!$validator->validate($comment)) {
				$this->view->errors  = $validator->getErrors();
				$this->view->comment = $comment;
				$this->view->userCaptcha = $this->_getParam('captcha');
			} else {
				$mapper = new SxCms_Comment_DataMapper();
				$mapper->save($comment);

				$captchaSession->unsetAll();
				$this->_helper->flashMessenger->addMessage('Uw bericht werd succcesvol verwerk.
					Na goedkeuring door een administrator zal dit op de website verschijnen.');

				$this->_helper->redirector->gotoRoute(array('url' => $page->getLink()), 'content');
			}
		}
	}

	public function quickAction() {
		$id = (int) $this->_getParam('id', 0);

		$proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageById($id, $this->_getParam('lng'));

		if ($page->getType() == SxCms_Page::EXTERNAL) {
            return $this->_helper->redirector->gotoUrl($page->getLink());
		}

		$this->_helper->redirector
			->setCode(303)
			->setExit(false)
			->gotoRoute(array('url' => $page->getLink(), 'lng' => $this->_getParam('lng', 'en')), 'content', false, false);
	}

	public function menuAction() {
        $nav = new SxCms_Nav($this->_getParam('lng', 'en'));
        $nav->setBounds(0, 2);

        if (true == ($page = $this->_getParam('page'))) {
            $nav->setActivePage($page);
        }

        $this->view->lng = $this->_getParam('lng');
		$this->view->menus = $nav->items();
	}
	
	public function multilevelmenuAction() {
        $nav = new SxCms_Nav($this->_getParam('lng', 'en'));
        $nav->setBounds(0, 4);

        if (true == ($page = $this->_getParam('page'))) {
            $nav->setActivePage($page);
        }

        $this->view->lng = $this->_getParam('lng');
		$this->view->menus = $nav->items();
	}

	public function submenuAction() {
		if (false == ($page = $this->_getParam('page'))) {
			return;
		}

		if (!$page->getId()) {
			return;
		}

		$pageProxy = new SxCms_Page_Proxy();

		$cTree = array();
		$tree  = $pageProxy->getPagesByParentId($page->getId());
		$breadcrumbs = $page->getBreadcrumbs($this->_getParam('lng', 'en'), true, false);

		$active = array();
		$active[] = $page->getId();

		if (isset($breadcrumbs[1])) {
			$active[] = $breadcrumbs[1]['page_id'];
			$tree = $pageProxy->getPagesByParentId($breadcrumbs[1]['page_id'], null, $this->_getParam('lng', 'en'), true, true);
			$cTree = array($breadcrumbs[1]['page_id'] => $tree);
		}

		if (isset($breadcrumbs[0])) {
			$active[] = $breadcrumbs[0]['page_id'];
			$tree = $pageProxy->getPagesByParentId($breadcrumbs[0]['page_id'], null, $this->_getParam('lng', 'en') , true, true);
		}

		$section = $pageProxy->getPageById($breadcrumbs[0]['page_id'], $this->_getParam('lng', 'en'));

		$submenus = array();
		foreach ($tree as $item) {
	
			$object = $item;
			
			if ($object->isInNavigation() === true &&
				$object->getDatePublished() <= strftime('%Y-%m-%d %H:%M:%S') &&
			   ($object->getDateExpired() >= strftime('%Y-%m-%d %H:%M:%S') ||
			   is_null($object->getDateExpired())  )
			) {
				$submenus[] = $item;
			}
		}

		$this->view->submenus    = $submenus;
		$this->view->subsubmenus = $cTree;
		$this->view->active      = $active;
		$this->view->section     = $section;
	}


	public function breadcrumbsAction() {
        $nav = new SxCms_Nav($this->_getParam('lng', 'en'));
        if (true == ($page = $this->_getParam('page'))) {
            $nav->setActivePage($page);
        }

		$this->view->breadcrumbs = $nav->breadcrumbs();
	}

	public function headAction() {
		$config = Zend_Registry::get('config');
		$this->view->headTitle()->setSeparator(' | ');
		
		$breadcrumbs = '';
		if (true == ($page = $this->_getParam('page'))) {
            $breadcrumbs = $page->getBreadcrumbs($this->_getParam('lng', 'en'), true);
			
			if($page->getSeoTitle())
	            $seotitle = $page->getSeoTitle();
			else 
				$seotitle = $page->getTitle();
			
			if($page->getSeoTags())
				$keywords = (string) $page->getSeoTags();
			else 
				$keywords = (string) $config->seo->keywords;
		
			if($page->getSeoDescription())
           		$description = (string) $page->getSeoDescription();
			else
				$description = (string) $config->seo->description;
        } 
		
		$this->view->headTitle($seotitle);
		$this->view->headTitle($config->seo->headtitle);
		$this->view->headMeta()->setName('keywords', (string) $keywords);
		$this->view->headMeta()->setName('description', (string) $description);



		$this->view->headMeta()->setName('author', 'Thieusmith © 2015');
		$this->view->headMeta()->setName('robots', 'index, follow, noarchive');
		$this->view->headMeta()->setName('googlebot', 'noarchive');
	}

	public function commentsAction() {
		$mapper = new SxCms_Comment_DataMapper();
		$page   = $this->_getParam('contentpage');

		$this->view->comments = $mapper->getCommentsByPage($page);
	}
	
	public function sitemapAction()  {
		$this->view->page = new SxCms_Page();

		$nav = new SxCms_Nav($this->_getParam('lng', 'en'));
        $nav->setBounds(1, 3);

        $this->view->lng = $this->_getParam('lng');
		$this->view->menus = $nav->sitemapItems();	

		$nav->setBounds(1,2);
		$this->view->topmenus = $nav->sitemapItems();	
	}

	public function xmlSitemapAction() {
		header("content-type: text/xml");
		$this->_helper->layout->disableLayout();
	}
}
