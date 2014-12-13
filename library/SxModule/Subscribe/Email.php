<?php

class SxModule_Subscribe_Email
{

	protected $_id;
	protected $_lng;
	protected $_subject;
	protected $_content;
	protected $_fromEmail;
	protected $_fromName;
	protected $_reply;
	protected $_replyName;

	public function getId() {
		return $this->_id;
	}
	public function setId($id) {
		$this->_id = $id;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($lng) {
		$this->_lng = $lng;
	}

	public function getSubject() {
		return $this->_subject;
	}
	public function setSubject($subject) {
		$this->_subject = $subject;
	}

	public function getContent() {
		return $this->_content;
	}
	public function setContent($content) {
		$this->_content = $content;
	}

	public function getFromEmail() {
		return $this->_fromEmail;
	}
	public function setFromEmail($fromEmail) {
		$this->_fromEmail = $fromEmail;
	}

	public function getFromName() {
		return $this->_fromName;
	}
	public function setFromName($fromName) {
		$this->_fromName = $fromName;
	}

	public function getReply() {
		return $this->_reply;
	}
	public function setReply($reply) {
		$this->_reply = $reply;
	}

	public function getReplyName() {
		return $this->_replyName;
	}
	public function setReplyName($replyName) {
		$this->_replyName = $replyName;
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Subscribe_Email_Mapper();
		
		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}

		if($this->getId()) {
			$id = $this->getId();
			$db->update('SubscribeMail', $data, 'id = ' . (int) $id);
			$db->update('SubscribeMailTsl', $tslData, 'mail_id = ' . (int)$id . ' AND lng = ' . $db->quote( $this->getLng() ));
		}
		else {
			$db->insert('SubscribeMail', $data);
			$id = $db->lastInsertId();
			
			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['mail_id'] = (int)$id;
				$db->insert('SubscribeMailTsl', $tslData);
			}
		}

		return $this;
	}

	public function delete($id) {
		$db = Zend_Registry::get('db');
		$db->delete('SubscribeMail', 'id = ' . $id);
		$db->delete('SubscribeMailTsl', 'mail_id = ' . $id);
	}
}