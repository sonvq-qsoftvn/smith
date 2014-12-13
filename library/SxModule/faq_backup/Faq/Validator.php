<?php

class SxModule_Faq_Validator extends Base_Validator
{

	protected $_namespace = 'SxModule_Faq';

	public function validateSelectRequired($text, $name = 'example', $tab = 'common') {
		if($text == 0) $text = '';

		$validator = new Zend_Validate_StringLength(1);
		$validator->setMessage('Dit is een verplicht veld!', Zend_Validate_StringLength::TOO_SHORT);
		if($validator->isValid($text)) return true;

		$msg = Sanmax_MessageStack::getInstance($this->_namespace);
		$msg->addMessage($name, $validator->getMessages(), $tab);
		return false;
	}

	public function validate(SxModule_Faq $object) {
		$this->validateSelectRequired($object->getType(), 'type', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getQuestion(), 'question', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getAnswer(), 'answer', 'settings', $this->_namespace);

		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}

}
