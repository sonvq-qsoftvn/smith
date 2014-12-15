<?php

class FaqController extends Zend_Controller_Action
{
    public function init()
    {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];

        $proxy = new SxCms_Page_Proxy();
        $this->view->page  = $proxy->getPageByUrl('faq', null, $this->_getParam('lng', 'en'));

        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);

        $this->view->faqpage = true;
    }


    public function indexAction(){
        $catProxy = new SxModule_Faq_Category_Proxy();
        $faqProxy = new SxModule_Faq_Proxy();
        $this->view->cats = $catProxy->getAll($_SESSION['System']['lng'],true);
        $this->view->faqs = $faqProxy->getAllGroupByParent($_SESSION['System']['lng'],true);
    }
}