<?php
class SxModule_Eyecatchers_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Eyecatchers';

	public function validate(SxModule_Eyecatchers $object) {
		$this->validateTextRequired($object->getTitle(), 'title', 'content', $this->_namespace);
		$this->validateTextRequired($object->getSubtitle(), 'subtitle', 'content', $this->_namespace);
		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;
		else return false;
	}
}