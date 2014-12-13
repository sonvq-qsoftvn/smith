<?php

class SxModule_Members_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Members';

	public function validatePassword($text, $name = 'example', $tab = 'common') {
		$validator = new Zend_Validate_StringLength(6, 32);
		if($validator->isValid($text)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance($this->_namespace);
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validate(SxModule_Members $object) {
		$this->validateTextRequired($object->getName(), 'name', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getFirstName(), 'first_name', 'settings', $this->_namespace);
		$this->validateEmail($object->getEmail(), 'email', 'settings', $this->_namespace);
		$this->validatePassword($object->getPassword(), 'password', 'settings', $this->_namespace);
		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}
}