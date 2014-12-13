<?php

class SxModule_Members_Email_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Members_Email';
	
	public function validate(SxModule_Members_Email $object) {
		
		$msgr = Sanmax_MessageStack::getInstance( $this->_namespace );
		if(!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}
}