<?php

class NewsController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl'));
	}

	public function latestAction() {
		$newsProxy = new SxModule_News_Proxy();
		$news = $newsProxy->getAll(true, $this->view->lng, true, 1, 10);

		//$page = new SxCms_Page();
		$pageProxy = new SxCms_Page_Proxy();
		$page = $pageProxy->getPageById( 242 );
		$this->view->page = $page;

		$this->view->news = $news;
	}

	public function archiveAction() {
		$newsProxy = new SxModule_News_Proxy();
		$news = $newsProxy->getAll(true, $this->view->lng, true, (int) $this->_getParam('page', 1), 10);

		//$page = new SxCms_Page();
		$pageProxy = new SxCms_Page_Proxy();
		$page = $pageProxy->getPageById( 242 );
		$this->view->page = $page;

		$this->view->news = $news;
	}

	public function detailAction() {
		$newsProxy = new SxModule_News_Proxy();
		$news = $newsProxy->getById((int) $this->_getParam('id'), $this->_getParam('lng'));

		//$page = new SxCms_Page();
		$pageProxy = new SxCms_Page_Proxy();
		$page = $pageProxy->getPageById( 242 );
		$this->view->page = $page;

		$this->view->news = $news;
	}
}
