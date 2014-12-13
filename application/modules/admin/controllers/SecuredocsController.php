<?php

class Admin_SecuredocsController extends Zend_Controller_Action
{

	protected $_item;
	protected $_action;

	public function init() {
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active' => 'menu-securedocs',
			'tab' => 'modules',
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/securedocs.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.index');
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = base64_decode($this->_getParam('path'));

		if($this->getRequest()->isPost()) {
			if(strlen($this->_getParam('folder')) > 0) {
				$dirname = $base . $path . '/' . $this->_getParam('folder');
				mkdir($dirname);
				if($path == '') {
					$newmap = new SxModule_Securedocs_Folder();
					$newmap->setFoldername($this->_getParam('folder'))->save();
				}
				$this->_redirect('/admin/securedocs/index/path/' . base64_encode($path));
			}
		}

		try {
			$it = new SxModule_Securedocs_Filesystem(realpath($base . $path));
		} catch (Exception $e) {
			$it = new SxModule_Securedocs_Filesystem($base);
			$path = ''; $e;
		}

		foreach($it as $file) {
			$files[strtolower($file->getFilename())] = $file->key();
		}
		ksort($files);

		$showPath = explode('/', $path);
		for($i = 1; $i < count($showPath); $i++) {
			$tmpPath = isset($showPath[$i - 1]['path']) ? $showPath[$i - 1]['path'] : '';
			$showPath[$i] = array(
				'path' => $tmpPath . '/' . $showPath[$i],
				'name' => $showPath[$i]
			);
		}
		array_shift($showPath);

		$this->view->files = $files;
		$this->view->path = $path;
		$this->view->showpath = $showPath;
		$this->view->it = $it;

		$topdir = explode('/', $path);
		if(count($topdir) > 1) {
			array_pop($topdir);
			$topdir = implode('/', $topdir);
		}
		else {
			$topdir = '';
		}
		$this->view->topdir = $topdir;
	}

	public function addAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.add');
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = base64_decode($this->_getParam('path'));

		if($this->getRequest()->isPost()) {
			$uploadAdapter = new Zend_File_Transfer_Adapter_Http();
			$uploadAdapter->setDestination($base . $path);
			$uploadAdapter->setOptions(array('ignoreNoFile' => true));
			$uploadAdapter->receive();

			$files = $uploadAdapter->getFileName(null, true);

			foreach($_FILES['file']['name'] as $key => $filename) {
				if(!$filename)
					continue;
				$summary = $this->_getParam('samenvatting');
				$mail = $this->_getParam('mail', '');

				$file = $base . $path . '/' . $filename;
				$newfile = $base . $path . '/' . str_replace(" ", "", $filename);
				rename($file, $newfile);
				$file = new SxModule_Securedocs_File($newfile);
				$file->setPath($path);
				$file->setSummary($summary[$key]);
				$file->setMail(isset($mail[$key]) ? "1" : "0");
				$file->save();

				if($mail[$key]) {
					$groups = explode('/', $path);
					$control = $path;
					if($control != "") {
						$proxy = new SxModule_Securedocs_Folder_Proxy();
						$folder = $proxy->getByFolder($groups[1]);
						$folderId = $folder->getFolderId();

						$proxy = new SxModule_Securedocs_Group_Proxy();
						$groups = $proxy->getAllByMap($folderId);

						$aantal = count($groups);
						$q = 0;
						$groupids = '(';
						foreach($groups as $group) {
							$q++;
							if($q != $aantal) {
								$groupids .= $group->getGroupId() . ",";
							}
							else {
								$groupids .= $group->getGroupId();
							}
						}
						$groupids .= ')';

						$proxy = new SxModule_Members_Proxy();
						$members = $proxy->getAllByGroups($groupids);
						foreach($members as $member) {
							$member->sendDocument($file);
						}
					}
				}
			}
			$this->_redirect('/admin/securedocs/index/path/' . base64_encode($path));
		}
		$this->view->path = $path;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Securedocs_File');
	}

	public function editAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.edit');
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = base64_decode($this->_getParam('path'));
		$file = base64_decode($this->_getParam('file'));
		$fullPath = realpath($base . $file);

		if(is_dir($fullPath)) {
			$mapname = array_pop(explode("/", $file));
			$this->view->mapname = $mapname;

			$file = new SxModule_Securedocs_Dir($fullPath);
			$file->setFilename($path);
		}
		elseif(is_file($fullPath)) {
			$file = new SxModule_Securedocs_File($fullPath);
			$file->setPath($path);
			$proxy = new SxModule_Securedocs_File_Proxy();
			$proxy->getFile($file);
			$filename = $file->getFilename();
			$extensie = array_pop(explode(".", $file));
			$filename = str_replace(".$extensie", "", $filename);
			$this->view->extensie = $extensie;
			$this->view->filename = $filename;
		}

		if($this->getRequest()->isPost()) {
			if($file instanceOf SxModule_Securedocs_Dir) {
				rename($fullPath, $base . $path . '/' . $this->_getparam('folder'));
				if($path == '') {
					$proxy = new SxModule_Securedocs_Folder_Proxy();
					$newmap = $proxy->getByFolder($mapname);
					$newmap->setFoldername($this->_getParam('folder'));
					$newmap->save();
				}
			}
			elseif($file instanceOf SxModule_Securedocs_File) {
				$newfilename = str_replace(" ", "", $this->_getParam('newfilename')) . "." . $extensie;
				rename($fullPath, $base . $path . "/" . $newfilename);
				$file->delete();
				$file = new SxModule_Securedocs_File($base . $path . "/" . $newfilename);
				$file->setPath($path);
				$file->setSummary($this->_getParam('samenvatting'));
				$file->setMail($this->_getParam('mail', '0') ? "1" : "0");
				$file->save();
			}
			$this->_redirect('/admin/securedocs/index/path/' . base64_encode($path));
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Securedocs_File');
		$this->view->file = $file;
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.delete');
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = base64_decode($this->_getParam('path'));
		$file = base64_decode($this->_getParam('file'));
		$fullPath = realpath($base . $file);
		if(is_dir($fullPath)) {
			$this->_deleteRecursive($file);
			$mapname = array_pop(explode("/", $file));
			$proxy = new SxModule_Securedocs_Folder_Proxy();
			$newmap = $proxy->getByFolder($mapname);
			if($newmap->getFolderName() != null) {
				$newmap->delete();
			}
		}
		elseif(is_file($fullPath)) {
			$file = new SxModule_Securedocs_File($fullPath);
			$file->setPath($path);
			$file->delete();
			unset($file);
			unlink($fullPath);
		}

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('filedeleted'));

		$this->_redirect('/admin/securedocs/index/path/' . $this->_getParam('path'));
	}

	private function _deleteRecursive($path) {
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$tmpPath = realpath($base . $path);
		$dir_handle = opendir($tmpPath);
		while($file = readdir($dir_handle)) {
			if($file != "." && $file != "..") {
				if(!is_dir($tmpPath . "/" . $file)) {
					$fileObj = new SxModule_Securedocs_File($tmpPath . "/" . $file);
					$fileObj->setPath($path);
					$fileObj->delete();
					unset($fileObj);
					unlink(realpath($tmpPath . "/" . $file));
				}
				else
					$this->_deleteRecursive($path . "/" . $file);
			}
		}
		closedir($dir_handle);
		rmdir($tmpPath);
		return true;
	}

	public function groupoverviewAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.index');
		$proxy = new SxModule_Securedocs_Group_Proxy();
		$items = $proxy->getAll();

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($items));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(20);

		$this->view->paginator = $paginator;
	}

	public function addgroupAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.add');
		$proxy = new SxModule_Securedocs_Folder_Proxy();
		$folders = $proxy->getAll();

		$this->view->folders = $folders;

		if($this->getRequest()->isGet()) {
			$item = new SxModule_Securedocs_Group();
		}

		if($this->getRequest()->isPost()) {
			$item = new SxModule_Securedocs_Group();
			$item->setGroup($this->_getParam('groupname'));
			$item->setMaps($this->_getParam('maps'));
			$item->setTmx($this->tmx);
			if($item->isValid()) {
				$item->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('groupcreated'));

				$this->_helper->redirector->gotoSimple('groupoverview', 'securedocs');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Securedocs_Group');
		$this->view->item = $item;
	}

	public function editgroupAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.edit');
		$proxy = new SxModule_Securedocs_Folder_Proxy();
		$folders = $proxy->getAll();

		$this->view->folders = $folders;

		if($this->getRequest()->isGet()) {
			$id = $this->_getParam('id');
			$proxy = new SxModule_Securedocs_Group_Proxy();
			$item = $proxy->getById($id);
		}

		if($this->getRequest()->isPost()) {
			$id = $this->_getParam('id');
			$proxy = new SxModule_Securedocs_Group_Proxy();
			$item = $proxy->getById($id);
			$item->setTmx($this->tmx);
			$item->setGroup($this->_getParam('groupname'));
			$item->setMaps($this->_getParam('maps'));

			if($item->isValid()) {
				$item->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('groupedited'));

				$this->_helper->redirector->gotoSimple('groupoverview', 'securedocs');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Securedocs_Group');
		$this->view->item = $item;
	}

	public function deletegroupAction() {
		SxCms_Acl::requireAcl('securedocs', 'securedocs.delete');
		$id = $this->_getParam('id');
		$proxy = new SxModule_Securedocs_Group_Proxy();
		$item = $proxy->getById($id);
		$item->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('groupdeleted'));

		$this->_helper->redirector->gotoSimple('groupoverview', 'securedocs');
	}
}