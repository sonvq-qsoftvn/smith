<?php

class SxModule_Members_Email
{
	protected $_tmx;
	protected $_id;
	protected $_lng;
	protected $_subject;
	protected $_content;
	protected $_fromEmail;
	protected $_fromName;
	protected $_reply;
	protected $_replyName;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return $this->_id;
	}
	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}

	public function getSubject() {
		return $this->_subject;
	}
	public function setSubject($subject) {
		$this->_subject = $subject;
		return $this;
	}

	public function getContent() {
		return $this->_content;
	}
	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}

	public function getFromEmail() {
		return $this->_fromEmail;
	}
	public function setFromEmail($fromEmail) {
		$this->_fromEmail = $fromEmail;
		return $this;
	}

	public function getFromName() {
		return $this->_fromName;
	}
	public function setFromName($fromName) {
		$this->_fromName = $fromName;
		return $this;
	}

	public function getReply() {
		return $this->_reply;
	}
	public function setReply($reply) {
		$this->_reply = $reply;
		return $this;
	}

	public function getReplyName() {
		return $this->_replyName;
	}
	public function setReplyName($replyName) {
		$this->_replyName = $replyName;
		return $this;
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Members_Email_Mapper();
		
		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}

		if($this->getId()) {
			$db->update('MemberMail', $data, 'id = ' . (int) $this->getId());
			$db->update('MemberMailTsl', $tslData, 'mail_id = ' . (int) $this->getId() . ' AND lng = ' . $db->quote( $this->getLng() ));
		}
		else {
			$db->insert('MemberMail', $data);
			
			$tslData['mail_id'] = $db->lastInsertId();
			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$db->insert('MemberMailTsl', $tslData);
			}
		}
		
		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('MemberMail', 'id = ' . (int) $this->getId());
		$db->delete('MemberMailTsl', 'mail_id = ' . (int) $this->getId());
	}

}