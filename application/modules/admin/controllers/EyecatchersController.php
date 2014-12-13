<?php

class Admin_EyecatchersController extends Zend_Controller_Action
{
	protected $_item;

	public function init() {
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active' => 'menu-eyecatchers',
			'tab' => 'modules',
		);
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/eyecatchers.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}




	protected function _imageResizeAndSave($object) {
		$path = APPLICATION_ROOT . '/public_html/images/eyecatchers/';
		$system->lng = $this->_getParam('lng');
		$adapter = new Zend_File_Transfer_Adapter_Http();
		$adapter->setDestination($path);
		$adapter->setOptions(array('ignoreNoFile' => true));

		if(!$adapter->receive()) {
			$msgr = Sanmax_MessageStack::getInstance('SxModule_Eyecatchers_Validator');
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




	public function indexAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.index');
		
		$proxy = new SxModule_Eyecatchers_Proxy();
		$items = $proxy->getAll($_SESSION['System']['lng'], false, true, $this->_getParam('page', 1), 25, true);

		$this->view->paginator = $items;
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.activate');
		
		$proxy = new SxModule_Eyecatchers_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'));
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Eyecatchers'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusitemedited'));
		$this->_helper->redirector->gotoSimple('index', 'eyecatchers');
	}

	public function rankingAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.ranking');
		$proxy = new SxModule_Eyecatchers_Proxy();
		foreach($_POST['listItem'] as $position => $item) :
			$product = $proxy->getById((int)$item);
			$product->updateRank($position);
		endforeach;
	}




	public function _editablefields() {
		return array( 'title', 'subtitle', 'url', 'picture', 'active' );
	}

	public function addAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.add');
		
		$data = new SxModule_Eyecatchers();
		$data->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Eyecatchers_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Eyecatchers_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($data);
				$data->setActive(1)
					->setPlace(0)
					->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Contentblock',
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'eyecatchers');
			}
		}
		
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Eyecatchers');
		$this->view->item = $data;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.edit');
		
		$proxy = new SxModule_Eyecatchers_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'), $_SESSION['System']['lng']);
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Eyecatchers_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $item);
			
			$validator = new SxModule_Eyecatchers_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($data);
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Eyecatchers'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'eyecatchers');
			}
			
			$item = $data;
		}

		$this->view->item = $item;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Eyecatchers');
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('eyecatchers', 'eyecatchers.delete');

		$proxy = new SxModule_Eyecatchers_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'));

		$picture = $item->getPicture();

		$pic1 = "images/eyecatchers/253X115/" . $picture;
		$pic2 = "images/eyecatchers/1263X325/" . $picture;
		$pic3 = "images/eyecatchers/1263X575/" . $picture;

		unlink($pic1);
		unlink($pic2);
		unlink($pic3);

		$item->delete();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Eyecatchers'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));
		
		$this->_helper->redirector->gotoSimple('index', 'eyecatchers');
	}
}