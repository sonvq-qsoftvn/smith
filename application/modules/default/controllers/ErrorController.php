<?php

class ErrorController extends Zend_Controller_Action
{
	protected function databaseError($error) {
		$file = APPLICATION_ROOT.'/tmp/error_reporting.data';
		$error_reporting = file_get_contents($file);

		if($error_reporting != '') {
			$error_reporting = unserialize($error_reporting);
		}

		if(APPLICATION_ENV == 'production') {
			if(is_writable($file) && ($error_reporting == '' || (isset($error_reporting['last_email']) && $error_reporting['last_email'] < time()-3600) )) {
				$mail = new Zend_Mail('utf-8');
				$mail->setSubject('Geen database connectie')
					->setFrom('vuquangson1610@gmail.com', 'Vu Quang Son');

        		$user = Zend_Auth::getInstance()->hasIdentity() ? Zend_Auth::getInstance()->getIdentity()->getEmail() : 'anonymous';

				$body = '<p>'
					.'Datum : '. date('Y-m-d H:i:s').'<br />'
					.'Domeinnaam: '.htmlspecialchars($_SERVER['SERVER_NAME']).'<br />'
					.'Error: '.htmlspecialchars($error)
					.'</p>'

					.'<p>'
					.'User: '.htmlspecialchars($user).'<br />'
					.'ip: '.htmlspecialchars($_SERVER['REMOTE_ADDR']).'<br />'
					.'agent: '.htmlspecialchars($_SERVER['HTTP_USER_AGENT']).'<br />'
					.'url: '.htmlspecialchars($this->view->url())
					.'</p>';

				$mail->setBodyHtml($body);

				$mail->addTo('thieusmith@gmail.com')
					->addCc('thieusmith@gmail.com')
					->addCc('thieusmith@gmail.com');

				$mail->send();

				$opt = array(
					'last_email' => time()
				);

				file_put_contents($file, serialize($opt));
			}
		}

	    echo $this->view->render('error/database.phtml');
	    exit; // Stop alles; omdat hierna misschien nog een database verbinding nodig is.
	}

    public function errorAction() {
    	/**
		 * Check database connection
		 */
        $this->view->lng = $this->_getParam('lng','nl');
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl'));     
		try {
		    $db = Zend_Registry::get('db');
		    $db->getConnection();
		} catch (Zend_Db_Adapter_Exception $e) {
		    // perhaps a failed login credential, or perhaps the RDBMS is not running
		    $this->databaseError($e);
		} catch (Zend_Exception $e) {
		    // perhaps factory() failed to load the specified Adapter class
		    $this->databaseError($e);
		}

		/**
		 * Normal error page
		 */
    	$this->view->page = new SxCms_Page();
    	$this->view->lng = $this->_getParam('lng','nl');
    	$this->_helper->layout->setLayout('default');
		$this->view->errorpage = true;

        $errors = $this->_getParam('error_handler');
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->render('404');
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

        $user = Zend_Auth::getInstance()->hasIdentity() ? Zend_Auth::getInstance()->getIdentity()->getEmail() : 'anonymous';

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
