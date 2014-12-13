<?php

class Admin_Sheets_TypeController extends Zend_Controller_Action
{

	protected $_type;

	public function init() {
		if(!isset($_SESSION['Cms_TypeWizard']['type'])) {
			$type = new SxModule_Sheets_Type();
			$_SESSION['Cms_TypeWizard']['type'] = $type;
		}
		$this->_type = &$_SESSION['Cms_TypeWizard']['type'];

		$this->view->menu = array(
			'tab' => 'modules',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-sheets'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/sheets.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.activate');
		$proxy = new SxModule_Sheets_Type_Proxy();
		$item = $proxy->getTypeById((int)$this->_getParam('id'), $_SESSION['System']['lng']);
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets_Type'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('De status van het item werd succesvol aangepast!');
		$this->_helper->redirector->gotoSimple('index', 'sheets_type');
	}

	public function rankingAction() {
		$logger = Zend_Registry::get('logger');

		SxCms_Acl::requireAcl('sheets', 'sheets.ranking');
		$proxy = new SxModule_Sheets_Type_Proxy();

		$logger->log($this->_getParam('listItem'), Zend_Log::INFO);

		foreach($this->_getParam('listItem') as $position => $item) {
			$product = $proxy->getTypeById((int)$item, $_SESSION['System']['lng']);
			$product->updateRank($position);

			$cache = Zend_Registry::get('cache');
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
				'SxModule_Sheets_Type'
			));

			$logger->log($product, Zend_Log::INFO);
		}
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.index');
		$proxy = new SxModule_Sheets_Type_Proxy();
		$types = $proxy->getAll($_SESSION['System']['lng']);

		$this->view->paginator = $types;
	}

	public function _editablefields() {
		return array(
			'name',
			'active'
		);
	}

	public function addAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.add');

		$type = new SxModule_Sheets_Type();

		if($this->getRequest()->isPost()) {
			$type = new SxModule_Sheets_Type();
			$proxyAll = new SxModule_Sheets_Type_Proxy();
			$pos = count($proxyAll->getAll());
			$pos++;

			$mapper = new SxModule_Sheets_Type_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Sheets_Type_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Sheets_Type'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Type werd succesvol aangemaakt!');

				$this->_helper->redirector->gotoSimple('index', 'sheets_type');
			}

			$type = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets_Type');
		$this->view->type = $this->_type;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.edit');
		$proxy = new SxModule_Sheets_Type_Proxy();

		$type_id = (int)$this->_getParam('id');
		$type = $proxy->getTypeById($type_id, $_SESSION['System']['lng']);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Sheets_Type_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $type);

			$validator = new SxModule_Sheets_Type_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Sheets_Type'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Type werd succesvol aangepast!');

				$this->_helper->redirector->gotoSimple('index', 'sheets_type');
			}
			
			$type = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets_Type');
		$this->view->type = $type;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.delete');
		$type_id = $this->_getParam('id');
		$proxy = new SxModule_Sheets_Type_Proxy();

		$this->_type = $proxy->getTypeById($type_id, $_SESSION['System']['lng']);
		$this->_type->delete();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets_Type'
		));

		$proxyAction = new SxModule_Sheets_Proxy();
		$proxyAction->deleteByType($type_id);

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Type werd succesvol verwijderd!');

		$this->_helper->redirector->gotoSimple('index', 'sheets_type');
	}

}
