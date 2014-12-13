<?php

class Admin_FilemanagerController extends Zend_Controller_Action
{
	public function init()
	{
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-filemanager',
			'tab'      => 'modules',
		);
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
	}

	public function indexAction()
	{
		SxCms_Acl::requireAcl('filemanager', 'filemanager.index');

		$base = APPLICATION_PATH . '/../public_html/files/';
		$base = realpath($base);

		$path = base64_decode($this->_getParam('path'));

		if ($this->getRequest()->isPost()) {
			if (null !== $this->_getParam('folder')) {
				SxCms_Acl::requireAcl('filemanager', 'filemanager.add.folder');
				if (strlen($this->_getParam('folder'))) {
					$dirname = $path . '/' . $this->_getParam('folder');

					mkdir($base . $dirname);
					$this->_redirect('/admin/filemanager/index/path/' . base64_encode($path));
				}
			} else {
				SxCms_Acl::requireAcl('filemanager', 'filemanager.add.file');
                $adapter = new Zend_File_Transfer_Adapter_Http();
                $adapter->setDestination(realpath($base) . $path);
                if ($adapter->receive()) {
                    $filename = realpath($adapter->getFileName('filename'));
                    $file = new SxCms_File($filename);

                    $path  = $file->getPathnameFromBase();
                    $nfile = $path . '/' . $file->getBasename();

                    $this->_redirect('/admin/filemanager/edit/file/' . base64_encode($nfile) . '/path/' . base64_encode($path));
                } else {
                    $msg = Sanmax_MessageStack::getInstance('SxCms_Filemanager');
                    $msg->addMessage('file', $adapter->getMessages());
                }
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Filemanager');

		try {
			$it = new SxCms_Filesystem(realpath($base . $path));
		} catch (Exception $e) {
			$it   = new SxCms_Filesystem($base);
			$path = '';
			$e;
		}

	 	$topdir = explode('/', $path);
		if (count($topdir) > 1) {
			array_pop($topdir);
			$topdir = implode('/', $topdir);
		} else {
			$topdir = '';
		}

		$this->view->files  = $it;
		$this->view->path   = $path;
		$this->view->showpath = explode('/', $path);
		$this->view->topdir = $topdir;

		if ($this->_getParam('full')) {
			$this->_helper->layout->setLayout('nolayout');
			$this->view->full = true;
		}
	}

	public function setTranslationAction()
	{
        $this->_helper->layout->setLayout('nolayout');
        $this->view->file = base64_decode($this->_getParam('file'));
	}

	public function editAction()
	{
		SxCms_Acl::requireAcl('filemanager', 'filemanager.edit');

        $mapper = new SxCms_Group_DataMapper();
        $this->view->groups = $mapper->getAll();

		$base = APPLICATION_PATH . '/../public_html/files/';
		if ($this->_getParam('file')) {
			$path = base64_decode($this->_getParam('file'));
			$file = new SxCms_File($base . $path);
		} else {
			$path = base64_decode($this->_getParam('dir'));
			$file = new SxCms_Dir($base . $path);
		}

		if ($this->getRequest()->isPost()) {
			$file->setFilename($this->_getParam('filename'));

			if ($this->_getParam('file')) {
				$file->setTitle($this->_getParam('title'))
				    ->setSource($this->_getParam('source'))
				    ->setSummary($this->_getParam('summary'))
				    ->setLink($this->_getParam('link'));

			    $file->clearPermissions();
	            foreach ((array) $this->_getParam('group') as $groupId) {
	                $group = new SxCms_Group();
	                $group->setId($groupId);

	                $file->addPermission($group);
                }
			}

			$file->save();

			$flashMessenger = $this->_helper->getHelper('FlashMessenger');
			$flashMessenger->addMessage('Bestand werd succesvol aangepast!');

			$this->_redirect('/admin/filemanager/index/path/' . $this->_getParam('path'));
		}

		$this->view->file = $file;
		$this->view->path = $this->_getParam('path');
	}

	public function deleteAction()
	{
		SxCms_Acl::requireAcl('filemanager', 'filemanager.delete');

		$base = APPLICATION_PATH . '/../public_html/files/';
		if ($this->_getParam('file')) {
			$path = base64_decode($this->_getParam('file'));
		} else {
			$path = base64_decode($this->_getParam('dir'));
		}

		$path = realpath($base . $path);
		if (is_dir($path)) {
			$this->_deleteRecursive($path);
		} else {
			$this->_deleteRecursive($path);
			unlink($path);
		}

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Bestand werd succesvol verwijderd!');

		$this->_redirect('/admin/filemanager/index/path/' . $this->_getParam('path'));
	}

	private function _deleteRecursive($path)
	{
		$dir_handle = opendir($path);
		while ($file = readdir($dir_handle)) {
			if ($file != '.' && $file != '..') {
				$fpath = $path . '/' . $file;
				if (!is_dir($fpath)) {
                    $this->_deleteFromIndex($fpath);
					unlink($fpath);
				} else {
					$this->_deleteRecursive($fpath);
				}
			}
		}

		closedir($dir_handle);
		rmdir($path);
		return true;
	}

	private function _deleteFromIndex($path)
	{
        $luceneIndex = APPLICATION_PATH . '/var/lucene-index';
        if (!is_dir($luceneIndex)) {
        	return false;
        }

        $index = Zend_Search_Lucene::open($luceneIndex);
        $uniqueId = md5('document_id_' . $path);

        $lTerm = new Zend_Search_Lucene_Index_Term($uniqueId, 'document_id');
        $lQuery = new Zend_Search_Lucene_Search_Query_Term($lTerm);

        $hits = $index->find($lQuery);
        foreach ($hits as $hit) {
            $doc = $hit->getDocument();
            if ($doc->document_id  == $uniqueId) {
                $index->delete($hit->id);
                return true;
            }
        }

        return false;
	}
}
