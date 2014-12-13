<?php

class SxModule_Members
{
	protected $_tmx;

	protected $_id;
	protected $_active;
	protected $_lng;
	protected $_sex;
	protected $_name;
	protected $_firstName;
	protected $_company;
	protected $_website;
	protected $_email;
	protected $_password;
	protected $_phone;
	protected $_fax;
	protected $_mobilePhone;
	protected $_street;
	protected $_number;
	protected $_postalcode;
	protected $_place;
	protected $_country;
	protected $_boardMember;
	protected $_groups = array();
	protected $_dateCreated;
	protected $_dateUpdated;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return (int)$this->_id;
	}
	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;
		return $this;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}

	public function getSex() {
		return $this->_sex;
	}
	public function setSex($sex) {
		$this->_sex = $sex;
		return $this;
	}

	public function getName() {
		return $this->_name;
	}
	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getFirstName() {
		return $this->_firstName;
	}
	public function setFirstName($firstName) {
		$this->_firstName = $firstName;
		return $this;
	}

	public function getCompany() {
		return $this->_company;
	}
	public function setCompany($company) {
		$this->_company = $company;
		return $this;
	}

	public function getWebsite() {
		return $this->_website;
	}
	public function setWebsite($website) {
		$this->_website = $website;
		return $this;
	}

	public function getEmail() {
		return $this->_email;
	}
	public function setEmail($email) {
		$this->_email = $email;
		return $this;
	}

	public function getPassword() {
		return $this->_password;
	}
	public function setPassword($password) {
		$this->_password = $password;
		return $this;
	}

	public function getPhone() {
		return $this->_phone;
	}
	public function setPhone($phone) {
		$this->_phone = $phone;
		return $this;
	}

	public function getFax() {
		return $this->_fax;
	}
	public function setFax($fax) {
		$this->_fax = $fax;
		return $this;
	}

	public function getMobilePhone() {
		return $this->_mobilePhone;
	}
	public function setMobilePhone($mobilePhone) {
		$this->_mobilePhone = $mobilePhone;
		return $this;
	}

	public function getStreet() {
		return $this->_street;
	}
	public function setStreet($street) {
		$this->_street = $street;
		return $this;
	}

	public function getNumber() {
		return $this->_number;
	}
	public function setNumber($number) {
		$this->_number = $number;
		return $this;
	}

	public function getPostalcode() {
		return $this->_postalcode;
	}
	public function setPostalcode($postalcode) {
		$this->_postalcode = $postalcode;
		return $this;
	}

	public function getPlace() {
		return $this->_place;
	}
	public function setPlace($place) {
		$this->_place = $place;
		return $this;
	}

	public function getCountry() {
		return $this->_country;
	}
	public function setCountry($country) {
		$this->_country = $country;
		return $this;
	}

	public function getBoardMember() {
		return $this->_boardMember;
	}
	public function setBoardMember($boardMember) {
		$this->_boardMember = $boardMember;
		return $this;
	}

	public function getGroups() {
		return $this->_groups;
	}
	public function setGroups($groups) {
		$this->_groups = (array)$groups;
		return $this;
	}

	public function getDateCreated() {
		return $this->_dateCreated;
	}
	public function setDateCreated($dateCreated) {
		$this->_dateCreated = $dateCreated;
		return $this;
	}

	public function getDateUpdated() {
		return $this->_dateUpdated;
	}
	public function setDateUpdated($dateUpdated) {
		$this->_dateUpdated = $dateUpdated;
		return $this;
	}




	public function controlLogin() {
		$proxy = new SxModule_Members_Proxy();

		if(!$proxy->checkLogin($this->getEmail())) {
			$message = array('wrong' => "Login doesn't excist.");

			$msg = Sanmax_MessageStack::getInstance('SxModule_Members');
			$msg->addMessage('login', $message, 'settings');

			return false;
		}

		return true;
	}

	public function controlPassword() {
		$proxy = new SxModule_Members_Proxy();

		if(!$proxy->checkPassword($this->getPassword(), $this->getEmail())) {
			$message = array('wrong' => "Wrong password.");

			$msg = Sanmax_MessageStack::getInstance('SxModule_Members');
			$msg->addMessage('password', $message, 'settings');

			return false;
		}

		return true;
	}

	public function checkLogin() {
		$this->controlLogin();
		$this->controlPassword();

		return count(Sanmax_MessageStack::getInstance('SxModule_Members')->getNamespaceMessages()) == 0;
	}

	private function _generatePwd() {
		$chars = "abcdefghkmnpqrstuvwxyz23456789";
		srand((double) microtime() * 1000000);
		$i = 0;
		$pass = '';

		while($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}

		$this->setPassword( $pass );
	}

	public function save() {
		$db = Zend_Registry::get('db');

		$mapper = new SxModule_Members_Mapper();
		$data = $mapper->toArray($this);

		if($this->getId() == 0) {
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$data['date_updated'] = '0000-00-00 00:00:00';

			$db->insert('Member', $data);

			if($this->getActive() == 1) {
				$this->sendRegistration();
			}

			$this->setId( $db->lastInsertId() );
			$db->delete('MemberGroups', 'member_id = ' . (int) $this->getId());

			if($this->_groups['0'] != '') {
				foreach($this->_groups as $group) {
					$db->insert('MemberGroups', array( 'member_id' => (int) $this->getId(), 'group_id' => (int) $group ));
				}
			}
		}
		else {
			$data['date_updated'] = new Zend_Db_Expr('NOW()');
			$db->update('Member', $data, 'id = ' . (int) $this->getId());
			$db->delete('MemberGroups', 'member_id = ' . (int) $this->getId());

			if($this->_groups['0'] != '') {
				foreach($this->_groups as $group) {
					$db->insert('MemberGroups', array( 'member_id' => (int) $this->getId(), 'group_id' => (int) $group ));
				}
			}
		}

		return true;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('Member', 'id = ' . (int) $this->getId());
		$db->delete('MemberGroups', 'member_id = ' . (int) $this->getId());
	}

	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 1) {
			$data = array('active' => 0);
			$this->setActive(0);
		}
		else {
			$data = array('active' => 1);
			$this->getActive(1);

			$this->sendRegistration();
		}

		$db->update('Member', $data, 'id = ' . (int) $this->getId());

		return true;
	}

	public function sendPassword() {
		$proxyMail = new SxModule_Members_Email_Proxy();
		$mailInfo = $proxyMail->getById('2', $this->getLng());
		$this->_send($mailInfo);
	}

	public function sendRegistration() {
		$proxyMail = new SxModule_Members_Email_Proxy();
		$mailInfo = $proxyMail->getById('1', $this->getLng());
		$this->_send($mailInfo);
	}

	public function sendDocument($file) {
		$proxyMail = new SxModule_Members_Email_Proxy();
		$mailInfo = $proxyMail->getById('3', $this->getLng());

		$filename = $file->getFilename();
		$path = $file->getPath();
		$desc = $file->getSummary();
		$docu = "Doc: " . $filename . "<br />";
		$docu .= "In map: " . $path . "<br />";
		$docu .= "On website: " . $_SERVER['SERVER_NAME'] . "<br />";

		if($desc != '') {
			$docu .= "Description: " . $desc;
		}

		$this->_send($mailInfo, $docu);
	}

	public function sendToAdmin() {
		$config = Zend_Registry::get('config');

		$subject = "Nieuwe registratie via website";
		$message = "<p>Er is een nieuwe registratie op de website, gelieve deze<br />
            rechten te geven en goed te keuren.De naam van de registratie is [name] [firstname], email: [email]</p>";

		$message = str_replace("[name]", $this->_name, $message);
		$message = str_replace("[firstname]", $this->_firstName, $message);
		$message = str_replace("[email]", $this->_email, $message);

		$mail = new Zend_Mail();
		$mail->setBodyText(strip_tags($message))
			->setBodyHtml($message)->setFrom($config->company->email, $fromname)
			->setReplyTo($config->company->email, $replyname)
			->setReturnPath($config->company->email)
			->addTo($config->company->email, 'website : ' . $config->company->name)
			->setSubject($subject)->send();
	}

	private function _send($mailInfo, $docuDescription = null) {
		$config = Zend_Registry::get('config');

		# check if member is active
		if($this->_active == 1) {
			$subject = $mailInfo->getSubject();

			$message = $mailInfo->getContent();
			$message = str_replace("[login]", $this->_email, $message);
			$message = str_replace("[password]", $this->_password, $message);
			$message = str_replace("[name]", $this->_name, $message);
			$message = str_replace("[firstname]", $this->_firstName, $message);
			$message = str_replace("[sex]", $this->_sex, $message);
			$address = $this->_street . " " . $this->_number . "<br />" . $this->_postalcode . " " . $this->_place . "<br />" . $this->_country . "<br />";
			$message = str_replace("[address]", $address, $message);

			$desciption = ($docuDescription) ? $docuDescription : '';

			$message = str_replace("[docu-description]", $docuDescription, $message);

			$fromemail = ($mailInfo->getFromEmail()) ? $mailInfo->getFromEmail() : $config->company->email;
			$fromname = ($mailInfo->getFromName()) ? $mailInfo->getFromName() : $config->company->name;
			$reply = ($mailInfo->getReply()) ? $mailInfo->getReply() : $config->company->email;
			$replyname = ($mailInfo->getReplyName()) ? $mailInfo->getReplyName() : $config->company->name;

			$toEmail = $this->_email;
			$toName = $this->_firstName . ' ' . $this->_name;

			$mail = new Zend_Mail();
			$mail->setBodyText(strip_tags($message))
				->setBodyHtml($message)
				->setFrom($fromemail, $fromname)
				->setReplyTo($reply, $replyname)
				->setReturnPath($fromemail)
				->addTo($toEmail, $toName)
				->setSubject($subject)->send();
		}
	}
}