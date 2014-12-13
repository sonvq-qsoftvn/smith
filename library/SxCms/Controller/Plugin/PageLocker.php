<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: PageLocker.php 8191 2010-05-28 11:33:53Z andries $
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
 * @package    SxCms_Controller_Plugin_PageLocker
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
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
