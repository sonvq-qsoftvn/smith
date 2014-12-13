<?php

class FilemanagerController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
	}

    public function indexAction()
    {
        $this->_helper->layout->setLayout('flexible');

		$base = APPLICATION_PATH . '/../public_html/files/docmanager/';
        $folder = $this->_getParam('folder', '');
        $path = realpath($base . '/' . $folder);

	 	$tparts = explode('/', $folder);
		if (count($tparts) >= 2) {
			array_pop($tparts);
			$topdir = implode('/', $tparts);
		} else {
			$topdir = '';
		}

		try {
			$it = new SxCms_Filesystem($path);
            $it->setApb($attributes);
		} catch (Exception $e) {
			$it   = new SxCms_Filesystem($base);
            $it->setApb($attributes);

			$path = '';
			$e;
		}


        $this->view->apb = $it->getApb();
		$this->view->files  = $it;
		$this->view->path   = $folder;
		$this->view->showpath = explode('/', $folder);
		$this->view->topdir = $topdir;
        $this->view->aapb = $tparts[0];
    }
}
