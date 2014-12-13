<?php

class Admin_TopcontentblockController extends Zend_Controller_Action
{

	protected $_block;

	public function init() {
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active' => 'menu-topblock',
			'tab' => 'modules',
		);
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/topcontentblock.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('topcontentblock', 'topcontentblock.index');
		$proxy = new SxModule_Topcontentblock_Proxy();
		$blocks = $proxy->getAll($_SESSION['System']['lng'], true, $this->_getParam('page', 1), 25);

		$this->view->paginator = $blocks;
	}

	protected function _imageResizeAndSave($object) {
		$path = APPLICATION_ROOT . '/public_html/images/topcontentblock/';
		$system->lng = $this->_getParam('lng');
		$adapter = new Zend_File_Transfer_Adapter_Http();
		$adapter->setDestination($path);
		$adapter->setOptions(array('ignoreNoFile' => true));

		if(!$adapter->receive()) {
			$msgr = Sanmax_MessageStack::getInstance('SxModule_Topcontentblock_Validator');
			$msgr->addMessage('file', $adapter->getMessages(), 'title');
		}

		if($object->getPicture() == null) {
			$object->setPicture('');
		}

		$files = $adapter->getFileInfo();
		foreach($files as $file) {
			if(!$file['tmp_name']) {
				continue;
			}

			$path0 = $path . "253X115/";
			$path1 = $path . "1263X575/";
			$path2 = $path . "1263X325/";
			$filename = $object->createThumbName($file['name']) . '_' . time() . '.jpg';

			$image = new Imagick($file['tmp_name']);
			$image->cropThumbnailImage(253, 115);
			$image->setCompression(Imagick::COMPRESSION_JPEG);
			$image->setImageCompressionQuality(100);
			$image->setImageFormat('jpeg');
			$image->writeImage($path0 . $filename);
			$image->clear();
			$image->destroy();

			$image = new Imagick($file['tmp_name']);
			$image->cropThumbnailImage(1263, 575);
			$image->setCompression(Imagick::COMPRESSION_JPEG);
			$image->setImageCompressionQuality(75);
			$image->setImageFormat('jpeg');
			$image->writeImage($path1 . $filename);
			$image->clear();
			$image->destroy();

			$image = new Imagick($file['tmp_name']);
			$image->cropThumbnailImage(1263, 325);
			$image->setCompression(Imagick::COMPRESSION_JPEG);
			$image->setImageCompressionQuality(75);
			$image->setImageFormat('jpeg');
			$image->writeImage($path2 . $filename);
			$image->clear();
			$image->destroy();

			unlink($file['tmp_name']);
			$object->setPicture($filename);
		}
	}

	public function _editablefields() {
		return array('title', 'content', 'url', 'picture', 'blockname');
	}

	public function addAction() {
		SxCms_Acl::requireAcl('topcontentblock', 'topcontentblock.add');

		$block = new SxModule_Topcontentblock();

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Topcontentblock_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);
			$data->setTmx($this->tmx);

			/* validate post */
			$validator = new SxModule_Topcontentblock_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($data);
				$data->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'topcontentblock');
			}

			$block = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Topcontentblock');
		$this->view->block = $block;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('topcontentblock', 'topcontentblock.edit');
		$id = (int) $this->_getParam('id');
		$proxy = new SxModule_Topcontentblock_Proxy();
		$block = $proxy->getById($id, $_SESSION['System']['lng']);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Topcontentblock_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $block);

			$validator = new SxModule_Topcontentblock_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($block);
				$block->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Topcontentblock'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'topcontentblock');
			}

			$item = $data;
		}

		$this->view->block = $block;
		$this->view->hidden = 'hidden';
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Topcontentblock');
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('topcontentblock', 'topcontentblock.delete');

		$proxy = new SxModule_Topcontentblock_Proxy();
		$item = $proxy->getById( (int) $this->_getParam('id') );
		$item->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'topcontentblock');
	}
}