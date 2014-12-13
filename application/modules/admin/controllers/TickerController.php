<?php
class Admin_TickerController extends Zend_Controller_Action {


	public function init() {
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-ticker',
			'tab'	   => 'modules'
		);
	}

	public function indexAction() {
		$system = new Zend_Session_Namespace('System');
		$proxy = new SxCms_Ticker_Proxy();
		$tickers  = $proxy->getAll($system->lng);

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($tickers));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function addAction() {
		$ticker = new SxCms_Ticker();
		$system = new Zend_Session_Namespace('System');
		
		if ($this->getRequest()->isPost()) {
			
			$ticker->setTitle($this->_getParam('title'))
				->setDate($this->_getParam('date'))
				->setUrl($this->_getParam('url'))
				->setLanguage($system->lng);

			if ($ticker->isValid()) {
			
				$ticker->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Ticker werd succesvol aangemaakt!');

				$this->_redirect('/admin/ticker');
			}
		}

		$this->view->ticker = $ticker;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Ticker');
	}
		
	public function editAction() {
		$proxy = new SxCms_Ticker_Proxy();
		$ticker = $proxy->getById($this->_getParam('id'));
		
		$system = new Zend_Session_Namespace('System');

		if ($this->getRequest()->isPost()) {

			$ticker->setTitle($this->_getParam('title'))
				->setUrl($this->_getParam('url'))
				->setDate($this->_getParam('date'))
				->setLanguage($system->lng);

			if ($ticker->isValid()) {
				$ticker->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Ticker werd succesvol aangepast!');

				$this->_redirect('/admin/ticker');
			}
		}

		$this->view->ticker = $ticker;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Ticker');
	}

	public function deleteAction() {
		$ticker = new SxCms_Ticker();
		$ticker->setTickId($this->_getParam('id'));
		$ticker->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Ticker werd succesvol verwijderd!');

		$this->_redirect('/admin/ticker/');
	}


}
?>