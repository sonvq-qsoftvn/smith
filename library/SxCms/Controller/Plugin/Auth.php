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

class SxCms_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();
        if ($front->getParam('isBot')) {
        	// todo
        }

    	$module   = $request->getModuleName();
    	$crtlact  = $request->getControllerName() . '.' . $request->getActionName();
    	$skiplist = array('account.login');

       	$auth = Zend_Auth::getInstance();
		if ($module === 'admin') {
			$auth->setStorage(new Zend_Auth_Storage_Session('User_Admin'));
		} else {
			$auth->setStorage(new Zend_Auth_Storage_Session('User_Front'));
		}

    	if ($module == 'admin' && !in_array($crtlact, $skiplist)) {
			if (!Zend_Auth::getInstance()->hasIdentity()) {
				$request->setControllerName('account')
					->setActionName('login')
					->setDispatched(false);
			}
    	}
    }
}
