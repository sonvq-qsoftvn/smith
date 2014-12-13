<?php

class SxModule_Sheets_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Sheets';

	public function validate(SxModule_Sheets $object) {
		
		$this->validateNumeric($object->getType(), 'type', 'settings', $this->_namespace);
		$this->validateNumeric($object->getSubtype(), 'subtype', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getName(), 'name', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getDesc(), 'desc', 'settings', $this->_namespace);

		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}
}