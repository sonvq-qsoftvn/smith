<?php

class SxCms_Contact
{
	protected $_tmx;
	protected $_company;
	protected $_btw;
    protected $_name;
    protected $_firstName;
	protected $_address;
	protected $_postal;
	protected $_country;
    protected $_email;
    protected $_phone;
	protected $_fax;
    protected $_message;
	protected $_domain;
	protected $_ext;
	protected $_transfer;
	protected $_package;

	/**
	 * Set the translation adapter
	 *
	 * @param object $tmx
	 * @return SxCms
	 */
	public function setTmx($tmx)
	{
		$this->_tmx = $tmx;
		return $this;
	}
	
	public function setCompany($company)
    {
        $this->_company = $company;
        return $this;
    }


    public function getCompany()
    {
        return $this->_company;
    }
	
	public function setBTW($btw)
    {
        $this->_btw = $btw;
        return $this;
    }


    public function getBtw()
    {
        return $this->_btw;
    }
	
    /**
     * Sets the member's name
     *
     * @param string $name
     * @return Krc_Member
     */
    public function setName($name)
    {
        $this->_name = strip_tags(trim($name));
        return $this;
    }

    /**
     * Get the member's last name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Validate the member's last name
     *
     * @return mixed - true when valid, array upon error
     */
    public function validateName()
    {
        $validator = new Zend_Validate_StringLength(2, 255);
        $validator->setMessage($this->_tmx->_('error.name.short'), Zend_Validate_StringLength::TOO_SHORT);
        $validator->setMessage($this->_tmx->_('error.name.long'),  Zend_Validate_StringLength::TOO_LONG);

        if (false === $validator->isValid($this->getName())) {
            return $validator->getMessages();
        }

        return true;
    }

    /**
     * Sets the member's first name
     *
     * @param string $fname
     * @return Krc_Member
     */
    public function setFirstName($fname)
    {
        $this->_firstName = strip_tags(trim($fname));
        return $this;
    }

    /**
     * Get the member's first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }
	
	public function setAddress($address)
    {
        $this->_address = $address;
        return $this;
    }


    public function getAddress()
    {
        return $this->_address;
    }
	
	public function setPostal($postal)
    {
        $this->_postal = $postal;
        return $this;
    }


    public function getPostal()
    {
        return $this->_postal;
    }
	
	public function setCountry($country)
    {
        $this->_country = $country;
        return $this;
    }


    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * Validate the member's first name
     *
     * @return mixed - true when valid, array upon error
     */
    public function validateFirstName()
    {
        $validator = new Zend_Validate_StringLength(2, 255);
        $validator->setMessage($this->_tmx->_('error.firstname.short'), Zend_Validate_StringLength::TOO_SHORT);
        $validator->setMessage($this->_tmx->_('error.firstname.long'), Zend_Validate_StringLength::TOO_LONG);

        if (false === $validator->isValid($this->getFirstName())) {
            return $validator->getMessages();
        }

        return true;
    }

    /**
     * Sets the member's email address
     *
     * @param string $email
     * @return Krc_Member
     */
    public function setEmail($email)
    {
        $this->_email = strip_tags(trim($email));
        return $this;
    }

    /**
     * Get the member's email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Validate the member's email address
     *
     * @return mixed - true when valid, array upon error
     */
    public function validateEmail()
    {
        $validator = new Zend_Validate_EmailAddress();
        if (false === $validator->isValid($this->getEmail())) {
            return array('invalid' => $this->_tmx->_('error.email.format'));
        }

        return true;
    }

    /**
     * Set the member's phone number
     *
     * @param string $phone
     * @return Krc_Member
     */
    public function setPhone($phone)
    {
        $this->_phone = strip_tags(trim($phone));
        return $this;
    }

    /**
     * Get the member's phone number
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Validate the member's phone number
     *
     * @return mixed - true when valid, array upon error
     */
    public function validatePhone()
    {
        $validator = new Zend_Validate_StringLength(5, 20);
        $validator->setMessage($this->_tmx->_('error.phone.short'), Zend_Validate_StringLength::TOO_SHORT);
        $validator->setMessage($this->_tmx->_('error.phone.long'),  Zend_Validate_StringLength::TOO_LONG);

        if (false === $validator->isValid($this->getPhone())) {
            return $validator->getMessages();
        }

        return true;
    }
	
		public function setFax($fax)
    {
        $this->_fax = $fax;
        return $this;
    }


    public function getFax()
    {
        return $this->_fax;
    }

    public function setMessage($message)
    {
        $this->_message = strip_tags(trim($message));
        return $this;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Validate the member's message
     *
     * @return mixed - true when valid, array upon error
     */
    public function validateMessage()
    {
        $validator = new Zend_Validate_StringLength(2);
        $validator->setMessage($this->_tmx->_('error.comments.short'), Zend_Validate_StringLength::TOO_SHORT);

        if (false === $validator->isValid($this->getMessage())) {
            return $validator->getMessages();
        }

        return true;
    }
	
	
	
	public function setDomain($domain)
    {
        $this->_domain = $domain;
        return $this;
    }


    public function getDomain()
    {
        return $this->_domain;
    }
	
		public function setExt($ext)
    {
        $this->_ext = $ext;
        return $this;
    }


    public function getExt()
    {
        return $this->_ext;
    }
	
		public function setTransfer($transfer)
    {
        $this->_transfer = $transfer;
        return $this;
    }


    public function getTransfer()
    {
        return $this->_transfer;
    }
	
	public function setPackage($package)
    {
        $this->_package = $package;
        return $this;
    }


    public function getPackage()
    {
        return $this->_package;
    }

    /**
     * Validate all user's data
     *
     * @return mixed - true when valid, array upon error
     */
    public function isValid()
    {
        $isValid = array(
           'email'     => $this->validateEmail(),
           'message'   => $this->validateMessage()
        );

        for ($i = 0; $i < count($isValid); $i++) {
            if (($isValid['email'] === true) && ($isValid['message'] === true)) {
                return true;
            }
        }
        return $isValid;
    }

    public function send()
    {
    	# Deze regels zijn niet nodig, maar moest iemand ze nodig hebben.. :-)
		// $tr = new Zend_Mail_Transport_Smtp('10.10.0.1');
		// Zend_Mail::setDefaultTransport($tr);

//        $mail = new Zend_Mail('utf-8');
//        $mail->setSubject('ThieuSmith Email Contact')
//            ->setFrom($this->getEmail(), $this->getEmail());
//		
//$body = 'Date : '   . date('Y-m-d H:i:s') . '
//Email : '     . $this->getEmail() . '
//Message : ' . $this->getMessage();
//		
//		$mail->setBodyText($body);
//		$mail->addTo('vuquangson1610@gmail.com');
//        //$mail->addTo(Zend_Registry::get('config')->contact->to);
//        return $mail->send();
//        
        $mail             = new PHPMailer();

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = "mail.yourdomain.com"; // SMTP server
        $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                   // 1 = errors and messages
                                                   // 2 = messages only
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "thieusmith.noreply@gmail.com";  // GMAIL username
        $mail->Password   = "convit123";            // GMAIL password

        $mail->SetFrom($this->getEmail(), 'Customer');

        $mail->AddReplyTo($this->getEmail(), "Customer");

        $mail->Subject    = "ThieuSmith Email Contact";
        $body = 'Hello Thieu Smith<br>I am ' . $this->getEmail() . '<br>And I want to: <br>' . $this->getMessage();
        $mail->MsgHTML($body);

        $mail->AddAddress('vuquangson@gmail.com', 'Thieu Smith');

        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Message sent!";
        }
    
    }
}
