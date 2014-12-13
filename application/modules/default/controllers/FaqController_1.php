<?php

class FaqController extends Zend_Controller_Action {

    public function init() {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);

        $proxy = new SxCms_Page_Proxy();
        $this->view->page = $proxy->getPageById('248', $this->_getParam('lng', 'nl'));
        $this->_helper->layout->setLayout('12col');
    }

    public function indexAction() {
        $types = SxModule_Faq_Type_Proxy::getAllActive();
        $this->view->types = $types;
    }
    
    public function detailAction() {
        $types = SxModule_Faq_Type_Proxy::getAllActive();
        $this->view->types = $types;

        $typeId = $this->_getParam('id', false);
        if ($typeId) {
            $questions = SxModule_Faq_Proxy::getAllByType($typeId);
            $this->view->questions = $questions;
            $type = SxModule_Faq_Type_Proxy::getTypeById($typeId);
            $this->view->type = $type;
        } else {
            if ($types) {
                $type = $types[0];

                $this->view->type = $type;
                $questions = SxModule_Faq_Proxy::getAllByType($type->getId());
                $this->view->questions = $questions;
            }
        }
    }

}
