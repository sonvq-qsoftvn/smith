<?php

class TickerController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$tickProxy = new SxCms_Ticker_Proxy();
		$ticks = $tickProxy->getAllActive($this->_getParam('lng', 'en'));

		if($ticks) {
			$this->view->ticks = $ticks;
		}
	}
}
