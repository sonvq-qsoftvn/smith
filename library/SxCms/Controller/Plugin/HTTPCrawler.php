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

class SxCms_Controller_Plugin_HTTPCrawler extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!isset($_SERVER['HTTP_USER_AGENT']) || (isset($_SERVER['HTTP_USER_AGENT']) && false === strpos($_SERVER['HTTP_USER_AGENT'], 'sanmax-crawler-bot'))) {
            return;
        }
        
        $config = array(
            'accept_schemes' => 'basic',
            'realm'          => 'crawler',
            'digest_domains' => '/',
            'nonce_timeout'  => 3600,
        );

        $adapter = new Zend_Auth_Adapter_Http($config);
        $basicResolver = new Zend_Auth_Adapter_Http_Resolver_File(APPLICATION_PATH . '/var/bot-basic');

        $adapter->setBasicResolver($basicResolver);

        $response = Zend_Controller_Front::getInstance()->getResponse();
        $adapter->setRequest($request);
        $adapter->setResponse($response);

        $auth = Zend_Auth::getInstance();

        $result = $auth->authenticate($adapter);
        if (!$result->isValid()) {
            $response->sendHeaders();
            exit;
        }

        $user = new SxCms_User();
        $gMapper = new SxCms_Group_DataMapper();
        $groups = $gMapper->getAll();
        foreach ($groups as $group) {
            $user->addGroup($group);
        }

        $storage = $auth->getStorage();
        $storage->write($user);

        $front = Zend_Controller_Front::getInstance();
        $front->setParam('isBot', true);

        $mvc   = Zend_Layout::getMvcInstance();
        $view  = $mvc->getView();
        $view->isBot = true;

        return;
    }
}
