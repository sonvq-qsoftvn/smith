<?php

class Admin_Sheets_SubtypeController extends Zend_Controller_Action
{

	protected $_subtype;

	public function init() {
		if(!isset($_SESSION['Cms_SubTypeWizard']['subtype'])) {
			$subtype = new SxModule_Sheets_Subtype();
			$_SESSION['Cms_SubTypeWizard']['subtype'] = $subtype;
		}
		$this->_subtype = &$_SESSION['Cms_SubTypeWizard']['subtype'];

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
		$id = $this->_getParam('id');
		$proxy = new SxModule_Sheets_Subtype_Proxy();
		$item = $proxy->getTypeById($id);
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets_Subtype'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
		$this->_helper->redirector->gotoRoute(array(
			'lng' => $this->lng, 'module' => 'admin', 'controller' => 'sheets_subtype', 'action' => 'index', 'type' => (int)$this->_getParam('type')
		), 'admin');
	}

	public function rankingAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.ranking');
		$proxy = new SxModule_Sheets_Subtype_Proxy();
		foreach($_POST['listItem'] as $position => $item) {
			$product = $proxy->getTypeById((int)$item);
			$product->updateRank($position);
			$cache = Zend_Registry::get('cache');
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
				'SxModule_Sheets_Subtype'
			));

		}

	}

	public function indexAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.index');
		$typeid = $this->_getParam('type');

		$proxy = new SxModule_Sheets_Subtype_Proxy();
		$types = $proxy->getAllByType($typeid, $_SESSION['System']['lng']);

		$proxy = new SxModule_Sheets_Type_Proxy();
		$type = $proxy->getTypeById((int)$typeid, $_SESSION['System']['lng']);
		$this->view->type = $type;

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets_Type'
		));

		$this->view->paginator = $types;
	}

	public function _editablefields() {
		return array( 'name', 'active' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.add');
		$proxy = new SxModule_Sheets_Type_Proxy();
		$type = $proxy->getTypeById((int)$this->_getParam('type'), $_SESSION['System']['lng']);
		$this->view->type = $type;

		$proxy = new SxModule_Sheets_Subtype_Proxy();
		$subtype = new SxModule_Sheets_Subtype();
		
		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Sheets_Subtype_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Sheets_Subtype_Validator();

			if($validator->validate($data)) {
				$type = $this->_getParam('type');

				$data->save($type);

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'sheets_subtype', 'admin', array('type' => $this->_getParam('type')));
			}

			$subtype = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets_Subtype');
		$this->view->subtype = $subtype;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.edit');
		$proxy = new SxModule_Sheets_Type_Proxy();
		$type = $proxy->getTypeById((int)$this->_getParam('type'), $_SESSION['System']['lng']);
		$this->view->type = $type;

		$proxy = new SxModule_Sheets_Subtype_Proxy();

		$subtype = $proxy->getTypeById((int)$this->_getParam('id'), $_SESSION['System']['lng']);

		if($this->getRequest()->isPost()) {
			
			$mapper = new SxModule_Sheets_Subtype_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $subtype);

			$validator = new SxModule_Sheets_Subtype_Validator();

			if($validator->validate($data)) {
				$data->save((int)$this->_getParam('type'));

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Sheets_Subtype'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'sheets_subtype', 'admin', array('type' => $this->_getParam('type')));
			}

			$subtype = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets_Subtype');
		$this->view->subtype = $subtype;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.delete');
		$type_id = $this->_getParam('id');
		$proxy = new SxModule_Sheets_Subtype_Proxy();

		$this->_subtype = $proxy->getTypeById($type_id);
		$this->_subtype->delete();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets_Subtype'
		));

		$proxyAction = new SxModule_Sheets_Proxy();
		$proxyAction->deleteByType($type_id);

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'sheets_subtype', 'admin', array('type' => $this->_getParam('type')));
	}

}
