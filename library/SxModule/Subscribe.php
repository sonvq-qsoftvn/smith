<?php

class SxModule_Subscribe
{
	protected $_tmx;

	protected $_id;
	protected $_lng;
	protected $_name;
	protected $_firstname;
	protected $_email;
	protected $_active;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

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

	public function getName() {
		return $this->_name;
	}
	public function setName($name) {
		$this->_name = $name;
	}

	public function getFirstname() {
		return $this->_firstname;
	}
	public function setFirstname($firstname) {
		$this->_firstname = $firstname;
	}

	public function getEmail() {
		return $this->_email;
	}
	public function setEmail($email) {
		$this->_email = $email;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;
	}
	
	
	

	public function save($params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Subscribe_Mapper();
		
		$data = $mapper->toArray($this, 'item');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if($this->getId()) {
			$db->update('Subscribe', $data, 'id = ' . (int)$this->getId());
		}
		else {
			$data['lng'] = $_SESSION['System']['lng'];
			$data['active'] = '0';
			$db->insert('Subscribe', $data);
			$this->setId($db->lastInsertId());
		}
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('Subscribe', 'id = ' . (int)$this->getId());
	}

	public function mail($email, $name, $firstname, $body = "", $subject = "") {
		$config = Zend_Registry::get('config');

		$name = $firstname." ".$name;

		$mail = new Zend_Mail();
		$mail
			->setBodyText(strip_tags($body))
			->setBodyHtml($body)
			->setFrom($config->company->email, $config->company->name)
			->addTo($email, $name)
			->setSubject($subject)
			->send();
	}

	public function sendConfirmation($url) {
		$proxyMail = new SxModule_Subscribe_Email_Proxy();
		$mailInfo = $proxyMail->getById('1', $this->getLng());
		$this->_send($mailInfo, $url);
	}

	private function _send($mailInfo, $url = null) {
		$config = Zend_Registry::get('config');

		$subject = $mailInfo->getSubject();

		$message = $mailInfo->getContent();
		$message = str_replace("[name]", $this->getName(), $message);
		$message = str_replace("[firstname]", $this->getFirstname(), $message);
		$message = str_replace("[url]", $url, $message);

		$fromemail = ($mailInfo->getFromEmail()) ? $mailInfo->getFromEmail() : $config->company->email;
		$fromname = ($mailInfo->getFromName()) ? $mailInfo->getFromName() : $config->company->name;
		$reply = ($mailInfo->getReply()) ? $mailInfo->getReply() : $config->company->email;
		$replyname = ($mailInfo->getReplyName()) ? $mailInfo->getReplyName() : $config->company->name;

		$toEmail = $this->getEmail();
		$toName = $this->getFirstname()." ".$this->getName();

		$mail = new Zend_Mail();
		$mail
			->setBodyText(strip_tags($message))
			->setBodyHtml($message)
			->setFrom($fromemail, $fromname)
			->setReplyTo($reply, $replyname)
			->setReturnPath($fromemail)
			->addTo($toEmail, $toName)
			->setSubject($subject)
			->send();
	}

	public function activate() {
		$db = Zend_Registry::get('db');
		$data['active'] = 1;
		$db->update('Subscribe', $data, 'id = ' . (int)$this->getId());
	}
}