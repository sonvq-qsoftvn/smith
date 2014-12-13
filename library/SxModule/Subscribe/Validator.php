<?php

class SxModule_Subscribe_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Subscribe';

	public function validate(SxModule_Subscribe $object) {
		$this->validateTextRequired($object->getName(), 'name', 'content', $this->_namespace);
		$this->validateTextRequired($object->getfirstname(), 'firstname', 'content', $this->_namespace);
		$this->validateEmail($object->getEmail(), 'email', 'content', $this->_namespace);
		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;
		else return false;
	}
}