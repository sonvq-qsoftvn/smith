<?php

class Base_Validator
{
	protected $tmx;

	public function setTmx($tmx) {
		$this->tmx = $tmx;
		return $this;
	}
	public function getTmx() {
		return $this->tmx;
	}

	protected function setErrors($validator, $errors) {
		if(is_array($errors)) {
			$validator->setMessages($errors);
		}
		elseif($errors !== false) {
			$validator->setMessage($errors);
		}
	}
	
	protected function getEmailmessages($message){
		$messages = array(
			'emailAddressInvalid' => $message, 
			'emailAddressInvalidFormat' => $message, 
			'emailAddressInvalidHostname' => $message, 
			'emailAddressInvalidMxRecord' => $message, 
			'emailAddressInvalidSegment' => $message, 
			'emailAddressDotAtom' => $message, 
			'emailAddressQuotedString' => $message, 
			'emailAddressInvalidLocalPart' => $message,
			'emailAddressLengthExceeded' => $message
		);
		return $messages;
	}

	public function validateTextRequired($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(2, 255);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateText($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(0, 255);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateTextareaRequired($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(2, 65535);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateTextarea($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(0, 65535);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}


	public function validateMediumTextareaRequired($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(2, 16777215);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateMediumTextarea($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(0, 16777215);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateLongTextareaRequired($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(2, 2147483647);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateLongTextarea($text, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_StringLength(0, 2147483647);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateCompare($text, $text2, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_Identical($text2);
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateInArray($text, $name = 'example', $values = array(), $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_InArray(array( 'haystack' => $values ));
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateEmail($email, $name = 'email', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_EmailAddress();
		$this->setErrors($validator, $errors);
		
		if($validator->isValid( $email )) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateNumeric($number, $name = 'number', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_Callback('is_numeric');
		$this->setErrors($validator, $errors);
		
		if($validator->isValid( $number )) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function _boolean($val1) {
		return is_bool($val1);
	}
	public function validateBoolean($bool, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_Callback(array( $this, '_boolean' ));
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($bool)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function _datetime($datetime) {
		return (is_numeric(strtotime($datetime))) ? true : false;
	}
	public function validateDateTime($datetime, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_Callback(array( $this, '_datetime' ));
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($datetime)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}
	public function validateDate($date, $name = 'example', $tab = 'common', $errors = false) {
		$validator = new Zend_Validate_Callback(array( $this, '_datetime' ));
		$this->setErrors($validator, $errors);
		
		if($validator->isValid($date)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}
	
	public function validateMinimum($value, $name ='example', $tab = 'common', $min = 0, $errors = false) {
		$validator = new Zend_Validate_GreaterThan(array('min' => $min));
		$this->setErrors($validator, $errors);

		if($validator->isValid((int)$value)){
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateMaximum($value, $name ='example', $tab = 'common', $max = 10, $errors = false) {
		$validator = new Zend_Validate_LessThan(array('max' => $max));
		$this->setErrors($validator, $errors);

		if($validator->isValid((int)$value)){
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validateBetween($value, $name ='example', $tab = 'common', $min = 0, $max = 10, $errors = false) {
		$validator = new Zend_Validate_Between(array('min' => $min, 'max' => $max));
		$this->setErrors($validator, $errors);

		if($validator->isValid((int)$value)){
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance( $this->_namespace );
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}
}