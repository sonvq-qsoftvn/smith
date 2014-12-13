<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Auth.php 8238 2010-05-31 14:48:43Z andries $
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
 * @package    SxCms_Controller_Plugin_Auth
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
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
