<?php

class Admin_ReportController extends Zend_Controller_Action
{
    public function brokenLinksAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$this->_helper->layout->disableLayout();

        $proxy = new SxCms_Page_Proxy();
        $stat = $proxy->getLinkStatus();

        echo json_encode($stat);
    }
}
