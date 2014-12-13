<?php

class SxModule_Contentblock_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Contentblock';
	
	public function validate(SxModule_Contentblock $object) {
		$this->validateTextRequired($object->getTitle(), 'title', 'content');
		$this->validateTextareaRequired($object->getContent(), 'content', 'content');

		$msgr = Sanmax_MessageStack::getInstance( $this->_namespace );
		if(!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}
}