<?php

class Admin_SubscribeController extends Zend_Controller_Action {

	protected $_item;

    public function init() {
        $this->view->menu = array(
            'template' => 'system/__modules.phtml',
            'active' => 'menu-subscribe',
            'tab' => 'modules'
        );
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $_SESSION['System']['lng']);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/subscribe.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

	public function _editablefields() {
		return array( 'from_name', 'from_email', 'reply_name', 'reply', 'subject', 'content' );
	}
	
	public function deletemailAction() {
		$data = new SxModule_Subscribe_Email();
		
        if ($this->getRequest()->isGet()) {
			$data->delete((int)$this->_getParam('id'));
			
			$cache = Zend_Registry::get('cache');
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
				'SxModule_Subscribe'
			));
		}

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('itemdeleted'));

		$this->_helper->redirector->gotoSimple('indexmail', 'subscribe');
	}
	
    public function indexmailAction() {
        $proxy = new SxModule_Subscribe_Email_Proxy();
        $items = $proxy->getAll($_SESSION['System']['lng']);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($items));
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $paginator->setItemCountPerPage(20);

        $this->view->paginator = $paginator;
    }

    public function addemailAction() {
		$item = new SxModule_Subscribe_Email();

        if ($this->getRequest()->isPost()) {
			$mapper = new SxModule_Subscribe_Email_Mapper();
			
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);
			$data->setLng($_SESSION['System']['lng']);

			$validator = new SxModule_Subscribe_Email_Validator();
			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Subscribe_Email'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('indexmail', 'subscribe');
			}
			
			$item = $data;
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Subscribe_Email');
        $this->view->item = $item;
    }

    public function editemailAction() {
		$proxy = new SxModule_Subscribe_Email_Proxy();
		$item = $proxy->getById((int)$this->_getParam('id'), $_SESSION['System']['lng']);

        if ($this->getRequest()->isPost()) {
			$mapper = new SxModule_Subscribe_Email_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields, $item);
			
			$data->setLng($_SESSION['System']['lng']);
			
			$validator = new SxModule_Subscribe_Email_Validator();

			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Subscribe'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage($this->admin_tmx->_('itemcreated'));

				$this->_helper->redirector->gotoSimple('indexmail', 'subscribe');
			}
			
			$item = $data;
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Subscribe_Email');
        $this->view->item = $item;
    }

    public function exportAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $title = $this->admin_tmx->_('exportresults');

        $proxy = new SxModule_Subscribe_Proxy();
        $registrations = $proxy->getAllActive();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("SxModule");
        $objPHPExcel->createSheet(0);
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPSheet = $objPHPExcel->getActiveSheet();

        $objPHPSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPSheet->getHeaderFooter()->setOddFooter('&R'.$this->admin_tmx->_('page').' &P '.$this->admin_tmx->_('from').' &N');
        $objPHPSheet->setShowGridlines(false);
        $objPHPSheet->getDefaultStyle()->getFont()->setSize(12.00);
        $objPHPSheet->getDefaultRowDimension()->setRowHeight(20);

        $objPHPSheet->setTitle($title);

        $margins = new PHPExcel_Worksheet_PageMargins();
        $margins->setLeft(0.2);
        $margins->setRight(0.2);
        $margins->setTop(0.2);
        $margins->setBottom(0.3);
        $objPHPSheet->setPageMargins($margins);

        $objPHPSheet->setCellValue('A3', $this->admin_tmx->_('id'));
        $objPHPSheet->setCellValue('B3', $this->admin_tmx->_('name'));
        $objPHPSheet->setCellValue('C3', $this->admin_tmx->_('firstname'));
        $objPHPSheet->setCellValue('D3', $this->admin_tmx->_('email'));
        $objPHPSheet->setCellValue('E3', $this->admin_tmx->_('language'));
        $objPHPSheet->setCellValue('F3', $this->admin_tmx->_('active'));
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $objPHPSheet->mergeCells('A1:D1');
        $objPHPSheet->duplicateStyleArray(array(
            'font' => array('size' => 21, 'bold' => TRUE)
                ), "A1:F1");
        $objPHPSheet->duplicateStyleArray(array(
            'font' => array('bold' => TRUE),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ), "A3:F3");
        $objPHPSheet->duplicateStyleArray(array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
            'alignment' => array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ), "A4:F" . (count($registrations) + 3));
        $objPHPSheet->duplicateStyleArray(array(
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ), "A4:F" . (count($registrations) + 3));

        $objPHPSheet->setCellValue('A1', $title);
        $rij = 3;
        foreach ($registrations as $result) {
            $rij++;
            $objPHPSheet->setCellValue('A' . $rij, $result->getId());
            $objPHPSheet->setCellValue('B' . $rij, $result->getName());
            $objPHPSheet->setCellValue('C' . $rij, $result->getFirstname());
            $objPHPSheet->setCellValue('D' . $rij, $result->getEmail());
            $objPHPSheet->setCellValue('E' . $rij, $result->getLng());
            $objPHPSheet->setCellValue('F' . $rij, $result->getActive());
        }
		
        for ($ii = 65; $ii < 68; $ii++) {
            $objPHPSheet->getColumnDimension(chr($ii))->setAutoSize(true);
        }
        $objPHPSheet->getColumnDimension("A")->setWidth(5);
        $objPHPSheet->getColumnDimension("B")->setWidth(30);
        $objPHPSheet->getColumnDimension("C")->setWidth(30);
        $objPHPSheet->getColumnDimension("D")->setWidth(30);
        $objPHPSheet->getColumnDimension("E")->setWidth(5);
        $objPHPSheet->getColumnDimension("F")->setWidth(5);

        $date = date('d-m-Y-h-i-s');
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=export-".$this->admin_tmx->_('registrations')."-$date.xls");
        header("Content-Transfer-Encoding: binary");

        $objWriter->save("php://output");
        die();
    }
}