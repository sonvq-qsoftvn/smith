<?php

class SheetsController extends Zend_Controller_Action {

    public function init() {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
        $this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);

        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoSimple('login', 'member');
        }

        $identity = Zend_Auth::getInstance()->getIdentity();
        $this->view->identity = $identity;
    }

    public function indexAction() {
        $proxy = new SxCms_Page_Proxy();
        $this->view->page = $proxy->getPageById('286', null, $this->_getParam('lng', 'en'));

        $proxy = new SxModule_Sheets_Type_Proxy();
        $types = $proxy->getAllActive();

        $typesAr = array();
        $xi = 0;
        foreach ($types as $type) :
            if (count($type->getSubtypes()) != 0):
                $proxy = new SxModule_Sheets_Proxy();
                $items = $proxy->getAllActiveByType($type->getId());
                $typesAr[$xi]['id'] = $type->getId();
                $typesAr[$xi]['name'] = $type->getName();
                $xi++;
            endif;
        endforeach;
        $this->view->types = $typesAr;
        $this->_helper->layout->setLayout('12col');
    }

    public function viewAction() {
        $typeName = $this->_getParam('typename');
        $typeId = $this->_getParam('typeid');
        $this->view->items = "";

        $proxy = new SxCms_Page_Proxy();
        $this->view->page = $proxy->getPageById('286', null, $this->_getParam('lng', 'en'));

        $proxy = new SxModule_Sheets_Type_Proxy();
        $types = $proxy->getAllActive();
        $this->view->types = $types;

        $masterArray = array();
        $typesAr = array();
        $xi = 0;
        $subtypesArray = array();
        foreach ($types as $type) :

            if (count($type->getSubtypes()) != 0):
                $proxy = new SxModule_Sheets_Proxy();
                $items = $proxy->getAllActiveByType($type->getId());
                $typesAr[$xi]['id'] = $type->getId();
                $typesAr[$xi]['name'] = $type->getName();
                $xi++;

                //geef items en subtitles door
                if ($type->getId() == $typeId) :
                    $this->view->items = $type->getSubtypes();
                endif;

            endif;
        endforeach;

        $this->view->typeid = $typeId;
        $this->view->types = $typesAr;
        $this->_helper->layout->setLayout('12col');
    }

    public function downloadAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $_SESSION['goto'] = '/file/download/filename/' . $this->_getParam('filename');
            $this->_forward('quick', 'index', null, array('id' => '286', 'lng' => $this->_getParam('lng', 'en')));
        } else {
            unset($_SESSION['goto']);
        }

        $filename = str_replace(' ', '%20', $this->_getParam('filename'));
        $title = $filename;
       
        $type = $this->_getParam('typeid');
        $subtype = $this->_getParam('subtypeid');
        $filename = APPLICATION_ROOT . '/public_html/securedocs/' . $type . '/' . $subtype . '/' . $filename;
        //$filename = realpath($filename);
        try {
            $file = str_replace('%20', ' ', $filename);
            
            $title = str_replace('%2C', ',',$title);
            header_remove();
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.str_replace('%20', '_',$title));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            /*header('Content-disposition: attachment; filename='.basename($file));
            header('Content-type: application/pdf');*/
            ob_clean();
            flush();
            readfile($file);
            exit;
        } catch (Exception $e) {
            header_remove();
            $this->_forward('quick', 'index', null, array('id' => '286', 'lng' => $this->_getParam('lng', 'en')));
        }
    }

}
