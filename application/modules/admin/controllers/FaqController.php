<?php
class Admin_FaqController extends Zend_Controller_Action {
    protected $_cat;

    public function init() {
        $this->view->menu = array(
            'template' => 'system/__modules.phtml',
            'active' => 'menu-faq',
            'tab' => 'modules',
        );
        $config = Zend_Registry::get('config');
        $lngs = $config->system->language;
        $this->view->lngs = $lngs;

        $proxy = new SxModule_Faq_Category_Proxy();
        $this->view->cats = $proxy->getAll($_SESSION['System']['lng']);
		
		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/faq.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

    public function activateAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Proxy();
        $item = $proxy->getById($id);
        $item->activate();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
        $this->_helper->redirector->gotoSimple('index', 'faqcategory');
    }

    public function rankingAction() {
        $proxy = new SxModule_Faq_Proxy();
        foreach ($_POST['listItem'] as $position => $item) :
            $product = $proxy->getById((int) $item);
            $product->updateRank($position);
        endforeach;
        die;
    }


    public function addAction() {
        if ($this->getRequest()->isGet()) {
            $this->_faq = new SxModule_Faq();
        }

        if ($this->getRequest()->isPost()) {
            $proxyAll = new SxModule_Faq_Proxy();
            $pos = count($proxyAll->getAll($_SESSION['System']['lng']));
            $pos++;

            $this->_faq = new SxModule_Faq();
            $this->_faq->setParentId($this->_getParam('parentID'));
            $this->_faq->setActive($this->_getParam('active'));
            $this->_faq->setLng($_SESSION['System']['lng']);
            $this->_faq->setQuestion($this->_getParam('question'));
            $this->_faq->setPosition($pos);
            $this->_faq->setAnswer($this->_getParam('answer'));

            /* validate post */
            if ($this->_faq->isValid()) {
                $this->_faq->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

                $this->_helper->redirector->gotoSimple('index', 'faqcategory');
            }
        }
		
		$config = Zend_Registry::get('config');

        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq');
        $this->view->item = $this->_faq;
		
		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/eyecatchers.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

    public function editAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Proxy();
        $item = $proxy->getById($id, $_SESSION['System']['lng']);

        if ($this->getRequest()->isPost()) {
            $this->_faq = $item;
            $this->_faq->setParentId($this->_getParam('parentID'));
            $this->_faq->setActive($this->_getParam('active'));
            $this->_faq->setLng($_SESSION['System']['lng']);
            $this->_faq->setQuestion($this->_getParam('question'));
            $this->_faq->setAnswer($this->_getParam('answer'));

            if ($this->_faq->isValid()) {
                $this->_faq->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

                $this->_helper->redirector->gotoSimple('index', 'faqcategory');
            }
        }

        $this->view->item = $item;
        $this->view->hidden = 'hidden';
        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq');
    }

    public function deleteAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Proxy();
        $item = $proxy->getById($id);
        $item->delete();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

        $this->_helper->redirector->gotoSimple('index', 'faqcategory');
    }

    public function resizeAndSave(){
        $path = APPLICATION_ROOT . '/public_html/images/subcategory/';
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->setDestination($path);
        $adapter->setOptions(array('ignoreNoFile' => true));

        if (!$adapter->receive()) {
            $msgr = Sanmax_MessageStack::getInstance('SxModule_Faq');
            $msgr->addMessage('file', $adapter->getMessages(), 'file');
        }

        $files = $adapter->getFileInfo();
        foreach ($files as $file) {
            if ($file['tmp_name'] == '') {
                continue;
            }

            $path0 = $path . "228X123/";
            $path1 = $path . "466X123/";
            $filename = $this->_faq->createThumbName($file['name']) . '_' . time() . '.jpg';

            $image = new Imagick($file['tmp_name']);
            $image->cropThumbnailImage(228, 123);
            $image->setCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality(100);
            $image->setImageFormat('jpeg');
            $image->writeImage($path0 . $filename);
            $image->clear();
            $image->destroy();

            $image = new Imagick($file['tmp_name']);
            $image->cropThumbnailImage(466, 123);
            $image->setCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality(100);
            $image->setImageFormat('jpeg');
            $image->writeImage($path1 . $filename);
            $image->clear();
            $image->destroy();

            unlink($file['tmp_name']);
           $this->_faq->setPicture($filename);
        }
    }
}