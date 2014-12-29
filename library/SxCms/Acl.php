<?php

/**
 * Development by thieusmith
 * @version $Id: Acl.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. thieusmith can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Acl
 * @copyright  Copyright (c) 2015 thieusmith. (thieusmith@gmail.com)
 */
class SxCms_Acl
{
	public static function requireAcl($resource, $priv)
	{
   		$user = Zend_Auth::getInstance()->getIdentity();
 		if (!$user->isAllowed($resource, $priv)) {
			$flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
			$flash->addMessage('U heeft niet voldoende rechten om deze actie uit te voeren');

			$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
			$redirector->setGotoSimple('login', 'account', null, array('redirect' => true));
		}
	}
}
