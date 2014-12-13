<?php

class Admin_SheetsController extends Zend_Controller_Action
{

	protected $_sheets;

	public function init() {
		if(!isset($_SESSION['Cms_RouteWizard']['sheets'])) {
			$sheets = new SxModule_Sheets();
			$_SESSION['Cms_RouteWizard']['sheets'] = $sheets;
		}
		$this->_sheets = &$_SESSION['Cms_RouteWizard']['sheets'];

		$this->view->menu = array(
			'tab' => 'modues',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-sheets'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/sheets.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function activateAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.activate');
		$id = $this->_getParam('id');
		$proxy = new SxModule_Sheets_Proxy();
		$item = $proxy->getById($id);
		$item->activate();

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_Sheets'
		));

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('statusedited'));
		$this->_helper->redirector->gotoSimple('index', 'sheets');
	}

	public function rankingAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.ranking');

		$proxy = new SxModule_Sheets_Proxy();
		foreach($_POST['listItem'] as $position => $item) {
			$product = $proxy->getById((int)$item);
			$product->updateRank($position);

			$logger = Zend_Registry::get('logger');
			$logger->log($product, Zend_Log::INFO);

			$cache = Zend_Registry::get('cache');
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
				'SxModule_Sheets'
			));

		}
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.index');
		$proxy = new SxModule_Sheets_Proxy();
		$sheets = $proxy->getAll(true, $this->_getParam('page', 1), 25, true);

		$this->view->paginator = $sheets;
	}

	public function _editablefields() {
		return array( 'type', 'subtype', 'name', 'desc', 'file', 'active' );
	}
	
	public function uploadFile($object, $type, $subtype) {
		
		$sheets = new SxModule_Sheets();
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = $type . '/' . $subtype;
		if(!is_dir($base . '/' . $path)) {
			echo $base . '/' . $path;
			mkdir($base . '/' . $type);
			mkdir($base . '/' . $path);
		}

		if($object->getFile() == null) {
			$object->setFile('');
		}
		
		$uploadAdapter = new Zend_File_Transfer_Adapter_Http();
		$uploadAdapter->setDestination($base . '/' . $path);
		$uploadAdapter->setOptions(array('ignoreNoFile' => true));
		$uploadAdapter->receive();

		$files = $uploadAdapter->getFileName(null, true);

		foreach($_FILES['file']['name'] as $key => $filename) {
			if(!$filename) {
				continue;
			}

			$file = $base . '/' . $path . '/' . $filename;
			$date = date('Y-m-d His');
			$path_info = pathinfo($filename);
			$myfilename = str_replace(' ', '_', $path_info['filename'] . '_' . $date . '.' . $path_info['extension']);
			$myfilename = $sheets->createFileName($myfilename);
			$newfile = $base . '/' . $path . '/' . $myfilename;

			rename($file, $newfile);

			$object->setFile( $myfilename );
		}
	}

	public function addAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.add');
		$proxy = new SxModule_Sheets_Type_Proxy();
		$this->view->types = $proxy->getAllActive($_SESSION['System']['lng']);

		$sheets = new SxModule_Sheets();

		if($this->getRequest()->isPost()) {

			$mapper = new SxModule_Sheets_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);
			$this->uploadFile($data, $this->_getParam('type'), $this->_getParam('subtype'));
			$validator = new SxModule_Sheets_Validator();

			if($validator->validate($data)) {

				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Sheets'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('index', 'sheets');
			}

			$sheets = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets');
		$this->view->item = $sheets;
	}

	public function editAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.edit');
		
		$proxy = new SxModule_Sheets_Type_Proxy();
		$this->view->types = $proxy->getAllActive($_SESSION['System']['lng']);

		$proxy = new SxModule_Sheets_Proxy();
		$sheets = $proxy->getById((int)$this->_getParam('id'));

		$subcat = new SxModule_Sheets_Subtype_Proxy();
		$this->view->subcat = $subcat->getAllbyType($sheets->getType(), $_SESSION['System']['lng'], true);

		if($this->getRequest()->isPost()) {
			
			$mapper = new SxModule_Sheets_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $sheets);
			$this->uploadFile($data, $this->_getParam('type'), $this->_getParam('subtype'));
			$validator = new SxModule_Sheets_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Sheets'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemedited'));

				$this->_helper->redirector->gotoSimple('index', 'sheets');
			}

			$sheets = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Sheets');
		$this->view->item = $sheets;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('sheets', 'sheets.delete');
		$sheet_id = $this->_getParam('id');
		$proxy = new SxModule_Sheets_Proxy();

		$this->_sheets = $proxy->getById($sheet_id);
		$this->_sheets->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'sheets');
	}

	public function getSubtypeAction() {
		$subcat = new SxModule_Sheets_Subtype_Proxy();
		$type = $this->_getParam('typeid');
		$this->view->subcat = $subcat->getAllbyTypeActive($type, $_SESSION['System']['lng'], true);

		$view = utf8_encode($this->view->render('sheets/get-subtype.phtml'));
		$results = Zend_Json::encode(array('subcat' => utf8_encode($view)));

		$this->view->results = $results;
		$this->render('json');
		$this->_helper->layout->disableLayout();
	}

}
