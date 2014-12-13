<?php

class Admin_Faq_TypeController extends Zend_Controller_Action
{

	protected $_type;

	public function init() {
		if(!isset($_SESSION['Cms_TypeWizard']['type'])) {
			$type = new SxModule_Faq_Type();
			$_SESSION['Cms_TypeWizard']['type'] = $type;
		}
		$this->_type = &$_SESSION['Cms_TypeWizard']['type'];

		$this->view->menu = array(
			'tab' => 'modules',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-faq'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/faq.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu/faq.tmx', $systemAdmin->lng);

		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('faq', 'faq.index');
		$proxy = new SxModule_Faq_Type_Proxy();

		$types = $proxy->getAll($_SESSION['System']['lng']);

		$this->view->paginator = $types;
	}

	public function _editablefields() {
		return array( 'name', 'active' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('faq', 'faq.add');
		$proxy = new SxModule_Faq_Type_Proxy();

		$type = new SxModule_Faq_Type();

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Faq_Type_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Faq_Type_Validator();

			if($validator->validate($data)) {
				$item->save($this->_editablefields());

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'faq_type');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq_Type');
		$this->view->type = $this->_type;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('faq', 'faq.edit');
		$proxy = new SxModule_Faq_Type_Proxy();

		$type = $proxy->getTypeById((int)$this->_getParam('id'));

		if($this->getRequest()->isPost()) {
			$type->setTmx($this->tmx);

			$mapper = new SxModule_Faq_Type_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $type);

			$validator = new SxModule_Faq_Type_Validator();

			if($validator->validate($data)) {

				$data->save($this->_editablefields());

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'faq_type');
			}
			
			$type = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq_Type');
		$this->view->type = $type;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('faq', 'faq.delete');
		$proxy = new SxModule_Faq_Type_Proxy();

		$this->_type = $proxy->getTypeById((int)$this->_getParam('id'));
		$this->_type->delete();

		$proxyAction = new SxModule_Faq_Proxy();
		$proxyAction->deleteByType((int)$this->_getParam('id'));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'faq_type');
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('faq', 'faq.activate');

		$proxy = new SxModule_Faq_Type_Proxy();
		$item = $proxy->getTypeById((int)$this->_getParam('id'));
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Faq_Type'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
		$this->_helper->redirector->gotoSimple('index', 'faq_type');
	}
}