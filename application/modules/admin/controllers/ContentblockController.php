<?php

class Admin_ContentblockController extends Zend_Controller_Action
{
	protected $_block;

	public function init() {
        $_SESSION['System']['lng'] = 'en';
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active' => 'menu-block',
			'tab' => 'modules',
		);
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $systemAdmin->lng);
		
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/contentblock.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('block', 'block.index');

		$proxy = new SxModule_Contentblock_Proxy();
		$blocks = $proxy->getAll($_SESSION['System']['lng'], true, (int)$this->_getParam('page', 1), 25, true);

		$this->view->paginator = $blocks;
	}

	public function _editablefields() {
		return array( 'title', 'content', 'blockname' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('block', 'block.add');

		$item = new SxModule_Contentblock();
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Contentblock_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Contentblock_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Contentblock',
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('contentblockcreated'));

				$this->_helper->redirector->gotoSimple('index', 'contentblock');
			}

			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Contentblock');
		$this->view->block = $item;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('block', 'block.edit');

		$proxy = new SxModule_Contentblock_Proxy();
		$block = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);
		$block->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Contentblock_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $block);
			
			$validator = new SxModule_Contentblock_Validator();

			if($validator->validate($data)) {

				$block->save($this->_editablefields());

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Contentblock'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('contentblockedited'));

				$this->_helper->redirector->gotoSimple('index', 'contentblock');
			}

			$item = $data;
		}

		$this->view->block = $block;
		$this->view->hidden = 'hidden';
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Contentblock');
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('block', 'block.delete');

		$proxy = new SxModule_Contentblock_Proxy();
		$album = $proxy->getById((int)$this->_getParam('id'));
		$album->delete();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Contentblock',
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('contentblockdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'contentblock');
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('block', 'block.activate');

		$proxy = new SxModule_Contentblock_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'));
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Contentblock',
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusitemedited'));
		$this->_helper->redirector->gotoSimple('index', 'contentblock');
	}
}