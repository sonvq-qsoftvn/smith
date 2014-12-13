<?php

class Admin_FaqController extends Zend_Controller_Action
{

	protected $_faq;

	public function init() {
		if(!isset($_SESSION['Cms_RouteWizard']['faq'])) {
			$faq = new SxModule_Faq();
			$_SESSION['Cms_RouteWizard']['faq'] = $faq;
		}
		$this->_faq = &$_SESSION['Cms_RouteWizard']['faq'];

		$this->view->menu = array(
			'tab' => 'modues',
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
		$proxy = new SxModule_Faq_Proxy();
		$faqs = $proxy->getAll(true, $this->_getParam('page', 1), 25);

		$this->view->paginator = $faqs;
	}

	public function _editablefields() {
		return array( 'question', 'answer', 'type', 'active' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('faq', 'faq.add');
		$proxy = new SxModule_Faq_Type_Proxy();
		$this->view->types = $proxy->getAll($_SESSION['System']['lng']);
		
		$faq = new SxModule_Faq();

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Faq_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Faq_Validator();

			if($validator->validate($data)) {
				$data->save();
				
				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'faq');
			}

			$faq = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq');
		$this->view->faq = $faq;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('faq', 'faq.edit');
		$proxy = new SxModule_Faq_Type_Proxy();
		$this->view->types = $proxy->getAll($_SESSION['System']['lng']);
		
		$proxy = new SxModule_Faq_Proxy();
		$faq = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$faq->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Faq_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $faq);

			$validator = new SxModule_Faq_Validator();

			if($validator->validate($data)) {
				$data->save();
				
				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Faq'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'faq');
			}

			$faq = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq');
		$this->view->faq = $faq;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('faq', 'faq.delete');
		$faq_id = $this->_getParam('id');
		$proxy = new SxModule_Faq_Proxy();

		$this->_faq = $proxy->getById($faq_id);
		$this->_faq->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'faq');
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('faq', 'faq.activate');

		$proxy = new SxModule_Faq_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'), $_SESSION['System']['lng']);
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Faq'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
		$this->_helper->redirector->gotoSimple('index', 'faq');
	}
}