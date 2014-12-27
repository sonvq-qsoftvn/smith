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
		$blocks = $proxy->getAll('en', true, $this->_getParam('page', 1), 25, false);

		$this->view->paginator = $blocks;
	}

	protected function _imageResizeAndSave($object) {
		$path = APPLICATION_ROOT . '/public_html/images/topcontentblock/';
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
        
        if($object->getThumb() == null) {
			$object->setThumb('');
		}

		$files = $adapter->getFileInfo();
        
        
		foreach($files as $key => $file) {
            if ($key == "picture") {
                if(!$file['tmp_name']) {
                    continue;
                }
                $path0 = $path . "large/";
                $filename = $object->createThumbName($file['name']) . '_' . time() . '.jpg';
                rename($file['tmp_name'], $path0.$filename);
                //unlink($file['tmp_name']);
                $object->setPicture($filename);
            } else if ($key == "thumb") {
                if(!$file['tmp_name']) {
                    continue;
                }
                $path1 = $path . "thumb/";
                $path2 = $path . "blackthumb/";
                $filename = $object->createThumbName($file['name']) . '_' . time() . '.jpg';
                
                $im = imagecreatefromjpeg($file['tmp_name']);
                if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
                {
                    imagejpeg($im, $path2.$filename);
                }
                else
                {
                    echo 'Conversion to grayscale failed.';
                }
                
                rename($file['tmp_name'], $path1.$filename);
                //unlink($file['tmp_name']);
                $object->setThumb($filename);
                
            }
		}
	}

	public function _editablefields() {
		return array('picture', 'thumb', 'blockname');
	}

	public function addAction() {
		SxCms_Acl::requireAcl('topcontentblock', 'topcontentblock.add');

		$block = new SxModule_Topcontentblock();

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Topcontentblock_Mapper();
            
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);
			$data->setTmx($this->tmx);

            $this->_imageResizeAndSave($data);
            
			/* validate post */
			$validator = new SxModule_Topcontentblock_Validator();
			if($validator->validate($data)) {
                
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

        $path = APPLICATION_ROOT . '/public_html/images/topcontentblock/';
        
		$proxy = new SxModule_Topcontentblock_Proxy();
		$item = $proxy->getById( (int) $this->_getParam('id'), 'en', false );
        
        $thumb = $item->getThumb();
        $picture = $item->getPicture();
        
        unlink($path . 'thumb/' . $thumb);
        unlink($path . 'blackthumb/' . $thumb);
        unlink($path . 'large/' . $picture);
		$item->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'topcontentblock');
	}
}