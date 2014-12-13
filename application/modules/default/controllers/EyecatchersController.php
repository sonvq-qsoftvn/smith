<?php

class EyecatchersController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl'));     
        }
        
        public function indexAction(){
            $lng = $this->_getParam('lng','nl');
            $proxy = new SxModule_Eyecatchers_Proxy();
            $items = $proxy->getAll($lng, true);
            $this->view->items = $items;
        }
  
	
}
