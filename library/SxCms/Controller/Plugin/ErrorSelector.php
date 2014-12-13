<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: ErrorSelector.php 8238 2010-05-31 14:48:43Z andries $
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
 * @package    SxCms_Controller_Plugin_ErrorSelector
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Controller_Plugin_ErrorSelector extends Zend_Controller_Plugin_Abstract
{
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();

        // If the ErrorHandler plugin is not registered, bail out
        if (!($front->getPlugin('Zend_Controller_Plugin_ErrorHandler') instanceOf Zend_Controller_Plugin_ErrorHandler)) {
            return;
        }

        $error = $front->getPlugin('Zend_Controller_Plugin_ErrorHandler');

        // Generate a test request to use to determine if the error controller in our module exists
        $testRequest = new Zend_Controller_Request_HTTP();
        $testRequest->setModuleName($request->getModuleName())
            ->setControllerName($error->getErrorHandlerController())
            ->setActionName($error->getErrorHandlerAction());

        // Does the controller even exist?
        if ($front->getDispatcher()->isDispatchable($testRequest)) {
            $error->setErrorHandlerModule($request->getModuleName());
        }
    }
}
