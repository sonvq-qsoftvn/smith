<?php

class SxModule_Sheets_Subtype_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Sheets_Subtype';
	
	public function validate(SxModule_Sheets_Subtype $object) {
		$this->validateTextRequired($object->getName(), 'name', 'settings', $this->_namespace);

		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}
}