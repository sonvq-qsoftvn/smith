<?php
class SxModule_Subscribe_Email_Validator extends Base_Validator
{
	protected $_namespace = 'SxModule_Subscribe_Email';

	public function validate(SxModule_Subscribe_Email $object) {
		
		//var_dump($object); exit;
		$this->validateTextRequired($object->getSubject(), 'subject', 'content');
		$this->validateTextareaRequired($object->getContent(), 'content', 'content');
		$this->validateTextRequired($object->getFromName(), 'from_name', 'settings');
		$this->validateTextRequired($object->getReplyName(), 'reply_name', 'settings');
		$this->validateEmail($object->getFromEmail(), 'from_email', 'settings');
		$this->validateEmail($object->getReply(), 'reply', 'settings');
		$msgr = Sanmax_MessageStack::getInstance($this->_namespace);
		if(!$msgr->getNamespaceMessages()) return true;

		return false;
	}
}