<?php
class Admin_FaqcategoryController extends Zend_Controller_Action {
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
		
		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/faq.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

    public function indexAction() {
        $proxy = new SxModule_Faq_Category_Proxy();
        $this->view->subproxy = new SxModule_Faq_Proxy();
        $items = $proxy->getAll($_SESSION['System']['lng']);

        $this->view->cats = $items;
    }

    public function activateAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Category_Proxy();
        $item = $proxy->getById($id);

        $item->activate();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
        $this->_helper->redirector->gotoSimple('index', 'faqcategory');
    }

    public function rankingAction() {
        $proxy = new SxModule_Faq_Category_Proxy();
        foreach ($_POST['listItem'] as $position => $item) :
            $product = $proxy->getById((int) $item);
            $product->updateRank($position);
        endforeach;
        die;
    }


    public function addAction() {
        $this->_cat = new SxModule_Faq_Category();

        if ($this->getRequest()->isPost()) {
            $this->resizeAndSave();
            $proxyAll = new SxModule_Faq_Category_Proxy();
            $pos = count($proxyAll->getAll($_SESSION['System']['lng']));
            $pos++;

            $this->_cat->setActive($this->_getParam('active'));
            $this->_cat->setLng($_SESSION['System']['lng']);
            $this->_cat->setTitle($this->_getParam('title'));
            $this->_cat->setPosition($pos);

            /* validate post */
            if ($this->_cat->isValid()) {
                $this->_cat->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

                $this->_helper->redirector->gotoSimple('index', 'faqcategory');
            }
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq_Category');
        $this->view->item = $this->_cat;
    }

    public function editAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Category_Proxy();
        $item = $proxy->getById($id, $_SESSION['System']['lng']);

        if ($this->getRequest()->isPost()) {
            $this->resizeAndSave();
            $this->_cat = $item;
            $this->_cat->setActive($this->_getParam('active'));
            $this->_cat->setLng($_SESSION['System']['lng']);
            $this->_cat->setTitle($this->_getParam('title'));

            if ($this->_cat->isValid()) {
                $this->_cat->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

                $this->_helper->redirector->gotoSimple('index', 'faqcategory');
            }
        }

        $this->view->item = $item;
        $this->view->hidden = 'hidden';
        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Faq_Category');
    }

    public function deleteAction() {
        $id = $this->_getParam('id');
        $proxy = new SxModule_Faq_Category_Proxy();
        $item = $proxy->getById($id);
        $item->delete();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

        $this->_helper->redirector->gotoSimple('index', 'faqcategory');
    }

    public function resizeAndSave(){
        $path = APPLICATION_ROOT . '/public_html/images/faqcategory/';
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->setDestination($path);
        $adapter->setOptions(array('ignoreNoFile' => true));

        if (!$adapter->receive()) {
            $msgr = Sanmax_MessageStack::getInstance('SxModule_Faq_Category');
            $msgr->addMessage('file', $adapter->getMessages(), 'file');
        }

        $files = $adapter->getFileInfo();
        foreach ($files as $file) {
            if ($file['tmp_name'] == '') {
                continue;
            }
            //unlink($file['tmp_name']);
           $this->_cat->setPicture($file['name']);
        }
    }
}