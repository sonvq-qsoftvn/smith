<?php
class SecuredocsController extends Zend_Controller_Action {

    public function init() {
        $this->view->lng = $this->_getParam('lng','nl');
        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl'));

        $proxy = new SxCms_Page_Proxy();
        $page = $proxy->getPageById('28', $this->_getParam('lng','nl'));
        $this->view->page = $page;

        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoSimple('login', 'member');
        }
    }

    public function indexAction() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoSimple('login', 'member');
        }

        $identity = Zend_Auth::getInstance()->getIdentity();

        //set base + path
        $base = APPLICATION_PATH . '/../public_html/securedocs/';
        $base = realpath($base);
        $path = base64_decode($this->_getParam('path'));

        if ($this->getRequest()->isPost()) {
            if ($this->_getParam('folder')) {
                if (!file_exists($base . $path . '/' . $this->_getParam('folder'))) {
                    mkdir ($base . $path . '/' . $this->_getParam('folder'));
                    if($path == '') {
                        //if path = '' add map in database
                        $newmap = new SxModule_Securedocs_Folder();
                        $newmap->setFoldername($this->_getParam('folder'));
                        $newmap->save();
                    }
                    $messages = 'Directory created !';
                    $this->view->messages = $messages;
                }
            } else {
                $adapter = new Zend_File_Transfer_Adapter_Http();
                $adapter->setDestination(realpath($base) . $path);
                $adapter->setOptions(array('ignoreNoFile' => true));
                $adapter->receive();

                if ($adapter->getFileName('filename')) {
                    $filename = realpath($adapter->getFileName('filename'));
                    $filename = str_replace(" ", "", array_pop(explode("/", $filename)));

                    $file = $adapter->getFileName('filename');
                    $newfile = $base . $path . '/' . $filename;
                    rename($file, $newfile);

                    $mail = $this->_getParam('mail');
                    if($mail){$mail = 1;}else{$mail = 0;}

                    $file = new SxModule_Securedocs_File($newfile);
                    $file->setMail($mail);
                    $file->setSummary($this->_getParam('samenvatting'));
                    $file->setPath($path);
                    $file->save();

                    $messages = 'File uploaded !';
                    $this->view->messages = $messages;

                    //als mail mag gest worden
                    if ($mail == '1'){
                        $groups = explode ('/', $path);

                        //get folder id to find group
                        $proxy = new SxModule_Securedocs_Folder_Proxy();
                        $folder = $proxy->getByFolder($groups[1]);
                        $folderId = $folder->getFolderId();

                        //get group id's that allows the folder to find the members
                        $proxy = new SxModule_Securedocs_Group_Proxy();
                        $groups = $proxy->getAllByMap($folderId);
                        //Zend_Debug::dump($groups);die();

                        $aantal = count($groups);
                        $q = 0;
                        $groupids = '(';
                        foreach($groups as $group) {
                            $q++;
                            if($q != $aantal) {
                                $groupids .= $group->getGroupId().",";
                            }else {
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
        }

        try {
            $it = new SxModule_Securedocs_Filesystem(realpath($base . $path));
        } catch (Exception $e) {
            $it   = new SxModule_Securedocs_Filesystem($base);
            $path = '';
            $e;
        }

        /*maps waar lid toegang tot heeft*/
        $aantal = count($identity->getGroups());
		$groups = $identity->getGroups();
		$testempty = (count($identity->getGroups())==1&&$groups[0]==''?true:false);

        if($aantal != '0' && $testempty == false){
            $q = 0;
            $groupids = '(';
            foreach($identity->getGroups() as $group) {
                $q++;
                if($q != $aantal) {
                    $groupids .= $group.",";
                }else {
                    $groupids .= $group;
                }
            }
            $groupids .= ')';

            $proxy = new SxModule_Securedocs_Group_Proxy();
            $groepen = $proxy->getAllMapsByGroupIds($groupids);

            //uiteindelijk de mappen waar het lid toegang tot heeft
            $accessGroups = array();
            foreach($groepen as $groep){
                $accessGroups[] = $groep['foldername'];
            }
        }else{$accessGroups = array();}

        //check if member has fullacces
        if($identity->getBoardMember() == '1') {
            $fullacces = true;
        }else{$fullacces = false;}

        /*get parentmap*/
        if($this->_getParam('path')) {
            $parentmap = base64_decode($this->_getParam('path'));
            $parentmap= explode("/",$parentmap);
            $parentmap = $parentmap[1];
        }else {
            $parentmap = '';
        }


        /* sort the files */
        foreach($it as $file) {
            if(isset($fullacces)) {
                $files[strtolower($file->getFilename())] = $file->key();
            }
            elseif(in_array($file, $accessGroups) || in_array($parentmap, $accessGroups)) {
                $files[strtolower($file->getFilename())] = $file->key();
            }
        }
        ksort($files);

        $showPath = explode('/', $path);
        for ($i = 1 ; $i < count($showPath) ; $i++) {
            $tmpPath = isset($showPath[$i - 1]['path'])?$showPath[$i - 1]['path']:'';
            $showPath[$i] = array('path' => $tmpPath . '/' . $showPath[$i] , 'name' => $showPath[$i]);
        }
        array_shift($showPath);

        $this->view->accessgroups = $accessGroups;
        $this->view->fullAccess = $fullacces;
        $this->view->files  = $files;
        $this->view->it		= $it;
        $this->view->path   = $path;
        $this->view->showpath = $showPath;
        $this->view->member = $identity;
    }

    public function downloadAction(){
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();

		$filename = APPLICATION_ROOT . '/public_html/securedocs/' . base64_decode($this->_getParam('filename'));
		$filename = realpath($filename);

		try {
            if (file_exists($filename)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($filename));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
                ob_clean();
                flush();
                readfile($filename);
                exit;
            }
		} catch (Exception $e) {
            throw new Zend_Controller_Action_Exception('File not found', 404);
		}
	}
}