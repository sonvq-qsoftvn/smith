<?php

class Admin_ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                break;
        }

        // log exception to database
        $db = Zend_Registry::get('db');
        $columnMapping = array(
            'priority'  => 'priority',
            'type'      => 'type',
            'message'   => 'message',
            'user'      => 'user',
            'ip'        => 'ip',
            'agent'     => 'agent',
            'url'       => 'url',
        );

        $user = Zend_Auth::getInstance()->hasIdentity()
              ? Zend_Auth::getInstance()->getIdentity()->getEmail()
              : 'anonymous';

        $writer = new Zend_Log_Writer_Db($db, 'Logs', $columnMapping);
        $logger = new Zend_Log($writer);
        $logger->setEventItem('user', $user);
        $logger->setEventItem('ip', $_SERVER['REMOTE_ADDR']);
        $logger->setEventItem('agent', $_SERVER['HTTP_USER_AGENT']);
        $logger->setEventItem('url', $this->view->url());
        $logger->setEventItem('type', $errors->type);

        $logger->err($errors->exception);
    }
}
