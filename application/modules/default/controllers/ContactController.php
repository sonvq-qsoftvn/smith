<?php

require_once 'Zend/Controller/Action.php';

class ContactController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
	}

    public function sentAction()
    {
        $this->_helper->layout->setLayout('full');
    }
    
    public function formAction()
    {
        $this->_helper->layout->setLayout('full');
        
		$lang = $this->_getParam('lng', 'nl');

		$fname = APPLICATION_ROOT . '/application/var/locale/contact.tmx';
		$tmx   = new Zend_Translate('tmx', $fname, $lang);

	
		$this->view->tmx = $tmx;
        
		$proxy = new SxCms_Page_Proxy();
		$page = $proxy->getPageByUrl('contact', null, $lang);
		$this->view->page = $page;
		
        if ($this->getRequest()->isGet()) {
            $contact = new SxCms_Contact();
			$this->view->captchaId = $this->generateCaptcha();
            $this->view->contact   = $contact;
        }

        if ($this->getRequest()->isPost()) {
            $contact = new SxCms_Contact();
            $contact->setTmx($tmx);

            $contact->setName($this->_getParam('name'))
                ->setFirstName($this->_getParam('fname'))
                ->setEmail($this->_getParam('email'))
                ->setPhone($this->_getParam('phone'))
                ->setMessage($this->_getParam('message'));
			
			if ($this->_getParam('captcha')) {
				$captcha = $this->_getParam('captcha');
				if ($this->validateCaptcha($captcha) ) {
					if (true === ($result = $contact->isValid())) {
						$test = $contact->send();
						
						//var_dump($test);die();

                        $this->_helper->redirector->gotoUrl('/nl/contact/verzonden');
					} else {
					
						$this->view->errors  = $result;
						$this->view->contact = $contact;
				
					    $this->view->captchaId = $this->generateCaptcha();
					}
				} else {
					$errors = array();
					$errors['captcha']['code'] = "De code werd verkeerd overgenomen.";
					$this->view->errors = $errors;
					$this->view->captchaId = $this->generateCaptcha();
					$this->view->contact = $contact;
				}
			}
        }
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
