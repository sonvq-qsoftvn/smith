<?php

class AuthController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
	}

	public function loginAction()
	{
            //$logger = Zend_Registry::get('logger');
            //$logger->log('bericht hier', Zend_Log::INFO);
            
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $config = Zend_Registry::get('config');
        $url = $config->system->web->url . $config->system->web->baseurl;

		$as = new SimpleSAML_Auth_Simple('klavsts');
		$options = array(
		    'saml:IsPassive' => true,
		    'KeepPost' => false,
		    'ReturnTo' => $this->view->url(),
		    'ErrorURL' => $url . '/index/unauthorized',
		);

		$as->requireAuth($options);
		$attributes = $as->getAttributes();

        $user = new SxCms_User_Klav();
        $user->setFirstName($attributes['urn:klav:data:Username'][0]);
        $user->setEmail($attributes['urn:klav:data:Email'][0]);
        $user->setDoccheck($attributes['urn:klav:data:doccheck'][0]);
        $user->setFarmanager($attributes['urn:klav:data:farmanager']);
        $user->setClientId($attributes['urn:klav:data:client'][0]);
        $user->setLanguage($attributes['urn:klav:data:taal_cd'][0]);
        $user->setGroups($attributes['urn:klav:groups']);
        $user->setDocmanager($attributes['urn:klav:docmanager']);
        $user->setClients($attributes['urn:klav:clients']);
        $user->setNamed($attributes['urn:klav:data:named'][0]);
        $user->setSessionId($attributes['urn:klav:sessionid'][0]);
        $user->setUsername($attributes['UserName'][0]);

        $mapper = new SxCms_Group_DataMapper();
        $groups = $attributes['groups'];
        foreach ($groups as $samlId) {
            $group = $mapper->getBySamlId($samlId);
            if ($group) {
                $user->addGroup($group);
            }
        }

		$auth = Zend_Auth::getInstance();
		$storage = $auth->getStorage();
		$storage->write($user);

        // full requested url
        $burl = $this->_getParam('url', '');
        $burl = base64_decode($burl);
        $burl = urldecode($burl);
        $burl = 'http://' . $this->getRequest()->getHttpHost() . $burl;

		$this->_helper->redirector->setGotoUrl($burl);
	}
	
	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();

        // full requested url
        $burl = $this->_getParam('url', '');
        $burl = base64_decode($burl);
        $burl = urldecode($burl);
        $burl = 'http://' . $this->getRequest()->getHttpHost() . $burl;

		$this->_helper->redirector->setGotoUrl("https://www.klav.be/Idp/logout.aspx?redirect_url=" . urlencode($burl));
	}
	
	public function boxAction()
	{
	}
}
