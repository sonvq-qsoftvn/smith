<?php

require_once 'Zend/Controller/Action.php';

class ContactController extends Zend_Controller_Action
{
	public function init() {
        $identity = Zend_Auth::getInstance()->getIdentity();
		$config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
		
        $fname = APPLICATION_ROOT . '/application/var/locale/contact.tmx';
        $gfname = APPLICATION_ROOT . '/application/var/locale/global.tmx';
		$tmx   = new Zend_Translate('tmx', $fname, $_SESSION['System']['lng']);
        $gtmx = new Zend_Translate('tmx', $gfname, $_SESSION['System']['lng']);
        
		$this->view->tmx = $tmx;
        $this->view->glob_tmx = $gtmx;
        
        $pageProxy = new SxCms_Page_Proxy();
        $page = $pageProxy->getPageById(4);
        $this->view->page = $page;
        $this->view->identity = $identity;
	}

    public function sentAction()
    {
        $this->_helper->layout->setLayout('full');
    }
    
    public function indexAction()
    {
        $this->_helper->layout->setLayout('full');
    }
    
    public function formAction()
    {
        $lang = $this->_getParam('lng', 'en');
        
        $this->_helper->layout->setLayout('full');
        $fname = APPLICATION_ROOT . '/application/var/locale/contact.tmx';
        $gfname = APPLICATION_ROOT . '/application/var/locale/global.tmx';
		$tmx   = new Zend_Translate('tmx', $fname, $_SESSION['System']['lng']);
        $gtmx = new Zend_Translate('tmx', $gfname, $_SESSION['System']['lng']);
        
		$proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageByUrl('contact', null, $_SESSION['System']['lng']);
		$this->view->page = $page;
        
        $contact = new SxCms_Contact();
        $contact->setTmx($tmx);

        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost();
            if (isset($request['submit'])) {
                if ($request['submit'] == "contact") {
                    $contact->setEmail($this->_getParam('email'))
                        ->setMessage($this->_getParam('message'));

                    $errors = array();
                    
                    if ((true === ($result = $contact->isValid()))) {
                        $test = $contact->send();
                        $this->_helper->redirector->gotoUrl('/' . $_SESSION['System']['lng'] . '/contact/verzonden');
                    } else {
                        if(is_array($result)) {
                            $this->view->errors  = array_merge($errors, $result);
                        } else {
                            $this->view->errors  = $errors;
                        }
                    }

                }
            }
        }
        
        $this->view->contact = $contact;
        $this->view->captchaId = $this->generateCaptcha();
    }

	public function generateCaptcha()
    {
		//generate new captcha
		$path = APPLICATION_ROOT . '/public_html/images/captcha';
		$captcha = new Zend_Captcha_Image();
        $captcha->setDotNoiseLevel(4);
        $captcha->setLineNoiseLevel(4);
		$captcha->setTimeout(300)
             ->setWordLen(4)
             ->setHeight(45)
             ->setFontSize(25)
             ->setFont(APPLICATION_ROOT . '/application/var/fonts/BRLNSR.TTF')
		     ->setImgDir($path);
        
		$captcha->generate();    //command to generate session + create image
		return $captcha->getId();   //returns the ID given to session &amp; image
	}
	
	public function validateCaptcha($captcha)
    {
        $captchaId = $captcha["id"];
        $captchaInput = $captcha["input"];
        $captchaSession = new Zend_Session_Namespace("Zend_Form_Captcha_" . $captchaId);
        $captchaIterator = $captchaSession->getIterator();
        if (isset($captchaIterator["word"]) ) {
            if ($captchaInput != $captchaIterator["word"]) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
	}
}
