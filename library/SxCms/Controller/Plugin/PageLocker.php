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

class SxCms_Controller_Plugin_PageLocker extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$controller = $request->getControllerName();
		$action = $request->getActionName();

		$blacklist = array(
			'wizardDone',
			'revisions',
			'index',
			'news',
			'addNews',
		);

		if ($controller !== 'page' or ($controller = 'page' && in_array($action, $blacklist))) {
			$wizard = new Zend_Session_Namespace('Cms_PageWizard');
			if (isset($wizard->page) && $wizard->page->isLocked()) {
				$wizard->page->unlock();
			}
		}
	}
}
