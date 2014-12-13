<?php

class TopcontentblockController extends Zend_Controller_Action {

    public function init() {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);
    }

    public function viewAction() {
        $name = $this->_getParam('name');
        $proxy = new SxModule_Topcontentblock_Proxy();
        $block = $proxy->getByBlockname($name, $_SESSION['System']['lng']);

        $this->view->spacer = $this->_getParam('spacer');
        $this->view->block = $block;
    }

}