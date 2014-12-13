<?php

class Admin_WebtvController extends Zend_Controller_Action
{

	protected $_item;
	protected $_action;

	public function init() {
		$this->view->menu = array(
			'tab' => 'modules',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-webtv'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/webtv.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('webtv', 'webtv.index');

		$proxy = new SxModule_Webtv_Proxy();
		$items = $proxy->getAll($_SESSION['System']['lng'], false, true, $this->_getParam('page', 1));
		$this->view->paginator = $items;
	}

	public function _editablefields() {
		return array( 'title', 'description', 'youtube', 'active', 'date_published' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('webtv', 'webtv.add');

		$item = new SxModule_Webtv();
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Webtv_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);
			
			$validator = new SxModule_Webtv_Validator();
			if($validator->validate($data)) {
				$data->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'webtv');
			}

			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Webtv');
		$this->view->item = $item;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('webtv', 'webtv.edit');
		$proxy = new SxModule_Webtv_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Webtv_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $item);

			$validator = new SxModule_Webtv_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Webtv'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'webtv');
			}

			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Webtv');
		$this->view->item = $item;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('webtv', 'webtv.delete');
		$id = (int) $this->_getParam('id');
		$proxy = new SxModule_Webtv_Proxy();
		$this->_item = $proxy->getById($id);
		$this->_item->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'webtv');
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('webtv', 'webtv.activate');
		$id = (int) $this->_getParam('id');
		$proxy = new SxModule_Webtv_Proxy();
		$item = $proxy->getById($id, $_SESSION['System']['lng']);
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Webtv'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
		$this->_helper->redirector->gotoSimple('index', 'webtv');
	}
}