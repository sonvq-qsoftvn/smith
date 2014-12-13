<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Messenger.php 8191 2010-05-28 11:33:53Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Controller_Plugin_Messenger
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Controller_Plugin_Messenger extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
		$mvc   = Zend_Layout::getMvcInstance();
		$view  = $mvc->getView();

		$view->flashMessages = $flash->getMessages();
	}
}
