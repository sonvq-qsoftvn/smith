<?php

class SxModule_Topcontentblock_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Topcontentblock';

	public function validate(SxModule_Topcontentblock $object) {
        $this->validateTextRequired($object->getPicture(), 'picture', 'content');
		$this->validateTextRequired($object->getThumb(), 'thumb', 'content');
        $this->validateTextRequired($object->getBlockname(), 'blockname', 'content');

		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}
}