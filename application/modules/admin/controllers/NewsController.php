<?php

class Admin_NewsController extends Zend_Controller_Action
{

	protected $_item;

	public function init() {

		$this->view->menu = array(
			'tab' => 'modules',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-news'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/news.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('news', 'news.index');

		$proxy = new SxModule_News_Proxy();
		$news = $proxy->getAll(false, $_SESSION['System']['lng'], true, $this->_getParam('page', 1), 25, true);

		$this->view->paginator = $news;
	}

	public function activateItemAction() {
		$proxy = new SxModule_News_Proxy();
		$newsitem = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);		
		$newsitem->activate();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('newsstatusedited'));
		$this->_helper->redirector->gotoSimple('index', 'news');
	}

	public function _editablefields() {
		return array( 'title', 'summary', 'content', 'seo_description', 'seo_title', 'seo_keywords', 'active', 'picture' );
	}

	protected function _imageResizeAndSave($object) {
		$path = APPLICATION_ROOT . '/public_html/images/news/';
		$system->lng = $this->_getParam('lng');
		$adapter = new Zend_File_Transfer_Adapter_Http();
		$adapter->setDestination($path);
		$adapter->setOptions(array('ignoreNoFile' => true));

		if(!$adapter->receive()) {
			$msgr = Sanmax_MessageStack::getInstance('SxModule_News_Validator');
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
			$path3 = $path . "scaled/";
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
			if ($image->getImageWidth() > 500) $image->scaleImage(500,500,true);
			if ($image->getImageHeight() > 500) $image->scaleImage(500,500,true);
			$image->writeImage($path3 . $filename);
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

	public function addAction() {
		SxCms_Acl::requireAcl('news', 'news.add');

		$item = new SxModule_News();

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_News_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$datePublished = $this->_getParam('date_published') . ' ' . $this->_getParam('publish_h') . ':' . $this->_getParam('publish_i') . ':00';

			$dateExpired = null;
			if($this->_getParam('date_expired')) {
				$dateExpired = $this->_getParam('date_expired') . ' ' . $this->_getParam('expire_h') . ':' . $this->_getParam('expire_i') . ':00';
			}

			$data->setDatePublished($datePublished)
				->setDateExpired($dateExpired)
				->setId((int) $item->getId())
				->setActive( ($this->_getParam('active',0) == 1) ? 1 : 0 );

			$validator = new SxModule_News_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($data);
				$data->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('newscreated'));

				$this->_helper->redirector->gotoSimple('index', 'news');
			}

			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_News');
		$this->view->item = $item;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('news', 'news.edit');
		
		$proxy = new SxModule_News_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'), $_SESSION['System']['lng']);
		$item->setTmx($this->tmx);

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_News_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $item);

			$datePublished = $this->_getParam('date_published') . ' ' . $this->_getParam('publish_h') . ':' . $this->_getParam('publish_i') . ':00';

			$dateExpired = null;
			if($this->_getParam('date_expired')) {
				$dateExpired = $this->_getParam('date_expired') . ' ' . $this->_getParam('expire_h') . ':' . $this->_getParam('expire_i') . ':00';
			}

			$data->setDatePublished($datePublished)
				->setDateExpired($dateExpired)
				->setActive( ($this->_getParam('active',0) == 1) ? 1 : 0 );

			$validator = new SxModule_News_Validator();

			if($validator->validate($data)) {
				$this->_imageResizeAndSave($data);
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_News'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('newsedited'));

				$this->_helper->redirector->gotoSimple('index', 'news');
			}

			$item = $data;
		}

		$this->view->item = $item;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_News');
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('news', 'news.delete');

		$proxy = new SxModule_News_Proxy();
		$item = $proxy->getById((int) $this->_getParam('id'), $_SESSION['System']['lng']);

		if($item->getId()) {
			$item->delete();
		}

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_News'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('newsdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'news');
	}
}