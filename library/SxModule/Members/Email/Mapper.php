<?php

class SxModule_Members_Email_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'subject' => array('type' => 'string', 'set' => 'setSubject'),
			'content' => array('type' => 'string', 'set' => 'setContent'),
			'from_email' => array('type' => 'string', 'set' => 'setFromEmail'),
			'from_name' => array('type' => 'string', 'set' => 'setFromName'),
			'reply' => array('type' => 'string', 'set' => 'setReply'),
			'reply_name' => array('type' => 'string', 'set' => 'setReplyName')
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Members_Email();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Members_Email $item, $type = '*') {
		$data = array(
			'id' => (int) $item->getId(),
			'from_email' => $item->getFromEmail(),
			'from_name' => $item->getFromName(),
			'reply' => $item->getReply(),
			'reply_name' => $item->getReplyName()
		);

		$tsl = array(
			'subject' => $item->getSubject(),
			'content' => $item->getContent()
		);

		if($type == 'item') {
			return $data;
		}
		elseif($type == 'tsl') {
			return $tsl;
		}

		return array_merge($data, $tsl);
	}
}