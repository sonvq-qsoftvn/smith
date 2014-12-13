<?php

class SxModule_News_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_News';

	public function validate(SxModule_News $object) {
		$this->validateTextRequired($object->getTitle(), 'title', 'content');
		$this->validateTextRequired($object->getSummary(), 'summary', 'content');
		$this->validateTextareaRequired($object->getContent(), 'content', 'content');
		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}
}