<?php

class SxModule_Webtv_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Webtv';
	
	public function validate(SxModule_Webtv $object) {
		$this->validateTextRequired($object->getTitle(), 'title', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getYoutube(), 'youtube', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getDatePublished(), 'date_published', 'settings', $this->_namespace);
		$this->validateTextRequired($object->getDescription(), 'description', 'content', $this->_namespace);
		
		$msgr = Sanmax_MessageStack::getInstance( $this->_namespace );
		if(!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}
}