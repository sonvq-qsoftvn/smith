<?php

class WorkController extends Zend_Controller_Action {

    public function init() {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);
    }

    public function indexAction() {
        $this->_helper->layout->setLayout('work');
        
		$lang = $this->_getParam('lng', 'en');
        
        $proxyWork = new SxModule_Topcontentblock_Proxy();
		$blocks = $proxyWork->getAll('en', false, 1, 1, false);

		$this->view->blocks = $blocks;
        
        $proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageById(1, $lang);
		$this->view->page = $page;
    }
    
}