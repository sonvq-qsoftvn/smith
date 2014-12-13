<?php

class Admin_MemberController extends Zend_Controller_Action
{

	protected $_item;
	protected $_action;

	public function init() {
		$this->view->menu = array(
			'tab' => 'modules',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-member'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/member.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('members', 'members.index');
		$proxy = new SxModule_Members_Proxy();
		$items = $proxy->getAll(true, 1, 25, true);

		$this->view->paginator = $items;
	}

	public function _editablefields() {
		return array(
			'active', 'sex', 'name', 'first_name', 'company',
			'website', 'email', 'password', 'phone', 'fax',
			'street', 'number', 'mobile_phone', 'groups', 'postalcode',
			'place', 'country', 'board_members', 'groups'
		);
	}

	public function addAction() {
		SxCms_Acl::requireAcl('members', 'members.add');
		$proxy = new SxModule_Securedocs_Group_Proxy();
		$groups = $proxy->getAll();
		$this->view->groups = $groups;

		$data = new SxModule_Members();
		$data->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Members_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Members_Validator();
			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Members'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'member');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members');
		$this->view->item = $data;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('members', 'members.edit');
		$proxy = new SxModule_Securedocs_Group_Proxy();
		$groups = $proxy->getAll();
		$this->view->groups = $groups;

		$proxy = new SxModule_Members_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Members_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $item);

			$validator = new SxModule_Members_Validator();
			if($validator->validate($data)) {
				$item->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Members'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'member');
			}
			
			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members');
		$this->view->item = $item;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('members', 'members.delete');
		$proxy = new SxModule_Members_Proxy();
		$this->_item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$this->_item->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('memberdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'member');
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('members', 'members.activate');
		$proxy = new SxModule_Members_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$item->activate();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('memberstatusedited'));
		$this->_helper->redirector->gotoSimple('index', 'member');
	}

	public function indexmailAction() {
		SxCms_Acl::requireAcl('members', 'members.index');
		$proxy = new SxModule_Members_Email_Proxy();
		$items = $proxy->getAll($_SESSION['System']['lng']);

		$this->view->paginator = $items;
	}

	public function _email_editablefields() {
		return array( 'subject', 'content', 'reply', 'reply_name', 'from_name', 'from_email' );
	}

	public function addemailAction() {
		SxCms_Acl::requireAcl('members', 'members.add');
		if($this->getRequest()->isGet()) {
			$item = new SxModule_Members_Email();
		}

		if($this->getRequest()->isPost()) {
			$item = new SxModule_Members_Email();
			$item->setTmx($this->tmx);
			$mapper = new SxModule_Members_Email_Mapper();

			$fields = $mapper->fromInput($this->_getAllParams(), $this->_email_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Members_Email_Validator();
			if($validator->validate($data)) {
				$data->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('mailcreated'));

				$this->_helper->redirector->gotoSimple('indexmail', 'member');
			}
			
			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members_Email');
		$this->view->item = $item;
	}

	public function editemailAction() {
		SxCms_Acl::requireAcl('members', 'members.edit');
		$proxy = new SxModule_Members_Email_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Members_Email_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_email_editablefields());
			$data = $mapper->toObject($fields, $item);

			$validator = new SxModule_Members_Email_Validator();
			if($validator->validate($data)) {
				$data->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('mailedited'));

				$this->_helper->redirector->gotoSimple('indexmail', 'member');
			}

			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members_Email');
		$this->view->item = $item;
	}

	public function deletemailAction() {
		SxCms_Acl::requireAcl('members', 'members.delete');
		$proxy = new SxModule_Members_Email_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'))->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('maildeleted'));

		$this->_helper->redirector->gotoSimple('indexmail', 'member');
	}
}