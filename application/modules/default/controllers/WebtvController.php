<?php

class WebtvController extends Zend_Controller_Action{
	public function init() {
        //include css files
        $this->view->headLink()->appendStylesheet('/webtv/css/youTubeEmbed-jquery-1.0.css');
        $this->view->headLink()->appendStylesheet('/webtv/css/webtv.css');

        //include javascript files
        $this->view->headScript()->appendFile('/webtv/js/specialJquery.js');
        $this->view->headScript()->appendFile('/webtv/js/jquery.swfobject.1-1-1.min.js');
        $this->view->headScript()->appendFile('/webtv/js/youTubeEmbed-jquery-1.0.js');
        
		$this->view->lng = $this->_getParam('lng','nl');
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl'));
	}

	public function latestAction(){
		$proxy = new SxModule_Webtv_Proxy();
        $items = $proxy->getAll($this->_getParam('lng','nl'), true, '5');

        $this->view->items = $items;
	}

	public function overviewAction(){
		$proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageById('26', $this->_getParam('lng','nl'));
		$this->view->page = $page;

		$proxy = new SxModule_Webtv_Proxy();
        $items = $proxy->getAll($this->_getParam('lng','nl'), true);

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($items));
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(1);

		$this->view->paginator = $paginator;
        $this->_helper->layout->setLayout('default');
	}
    
    public function detailAction(){
		$proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageById('26', $this->_getParam('lng','nl'));
		$this->view->page = $page;

        $url = $this->_getParam('url');
		$id = $this->_getParam('id');

        $proxy = new SxModule_Webtv_Proxy();
        $result = $proxy->controlId($id);
		 if($result['url'] != $url){
				$url = $this->view->url(array(
									'id' => $id,
									'url' => $result['url'],
									'lng' => $lng),
									'webtv-detail', true
							);
				$this->_redirect($url);
		 }

        $item = $proxy->getById($id, $this->_getParam('lng','nl'));

		$this->view->item = $item;
        $this->_helper->layout->setLayout('default');
	}


}
