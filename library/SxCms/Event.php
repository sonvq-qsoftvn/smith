<?php

class SxCms_Event
{
	protected $id;
	protected $language = 'nl';
	protected $description;
	protected $dateEvent;
	protected $timeEvent;
	protected $location;
	protected $mailRemember;
	protected $mailConfirmation;
	protected $subscriptionAllow = true;
	protected $subscriptionMax;
	protected $notifyEmail;
	protected $dateStart;
	protected $title;
	protected $dateEnd;
	protected $rememberDays = 0;
	protected $confirmationLink = true;
	protected $validateIntern = false;
	protected $_fields = array();

	public function __construct() {
		$this->dateStart = date("Y-m-d");
	}

	public function setId($id) {
		$this->id = (int)$id;
		return $this;
	}
	public function getId() {
		return (int)$this->id;
	}

	public function setLanguage($language) {
		$this->language = strtolower($language);
		return $this;
	}
	public function getLanguage() {
		return $this->language;
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}

	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}

	public function setDateEvent($dateEvent) {
		$this->dateEvent = $dateEvent;
		return $this;
	}
	public function getDateEvent($format = null) {
		if(is_null($this->dateEvent) || strlen($this->dateEvent) == 0) {
			return;
		}
		if($format) {
			return strftime($format, strtotime($this->dateEvent));
		}
		return $this->dateEvent;
	}

	public function setTimeEvent($timeEvent) {
		$this->timeEvent = $timeEvent;
		return $this;
	}
	public function getTimeEvent($format = null) {
		if($format) {
			return strftime($format, strtotime($this->timeEvent));
		}
		return $this->timeEvent;
	}

	public function setLocation($location) {
		$this->location = $location;
		return $this;
	}
	public function getLocation() {
		return $this->location;
	}

	public function setMailRemember($mailRemember) {
		$this->mailRemember = $mailRemember;
		return $this;
	}
	public function getMailRemember() {
		return $this->mailRemember;
	}

	public function setMailConfirmation($mailConfirmation) {
		$this->mailConfirmation = $mailConfirmation;
		return $this;
	}
	public function getMailConfirmation() {
		return $this->mailConfirmation;
	}

	public function setSubscriptionAllow($subscriptionAllow = true) {
		$this->subscriptionAllow = $subscriptionAllow;
		return $this;
	}
	public function isSubscriptionAllow() {
		return $this->subscriptionAllow;
	}

	public function setSubscriptionMax($subscriptionMax) {
		$this->subscriptionMax = $subscriptionMax;
		return $this;
	}
	public function getSubscriptionMax() {
		return $this->subscriptionMax;
	}

	public function setNotifyEmail($notifyEmail) {
		$this->notifyEmail = $notifyEmail;
		return $this;
	}
	public function getNotifyEmail() {
		return $this->notifyEmail;
	}

	public function setDateStart($dateStart) {
		$this->dateStart = $dateStart;
		return $this;
	}
	public function getDateStart($format = null) {
		if(is_null($this->dateStart) || strlen($this->dateStart) == 0) return;
		if($format) return strftime($format, strtotime($this->dateStart));
		return $this->dateStart;
	}

	public function setDateEnd($dateEnd) {
		$this->dateEnd = $dateEnd;
		return $this;
	}
	public function getDateEnd($format = null) {
		if(is_null($this->dateEnd) || strlen($this->dateEnd) == 0) return;
		if($format) return strftime($format, strtotime($this->dateEnd));
		return $this->dateEnd;
	}

	public function setRememberDays($rememberDays) {
		$this->rememberDays = $rememberDays;
		return $this;
	}
	public function getRememberDays() {
		return $this->rememberDays;
	}

	public function setConfirmationLink($confirmationLink = true) {
		$this->confirmationLink = $confirmationLink;
		return $this;
	}
	public function isConfirmationLink() {
		return $this->confirmationLink;
	}

	public function setValidateIntern($validateIntern = false) {
		$this->validateIntern = $validateIntern;
		return $this;
	}
	public function isValidateIntern() {
		return $this->validateIntern;
	}
	
	
	

	public function validateTitle() {
		$validator = new Zend_Validate_StringLength(2, 255);
		if(!$validator->isValid($this->title)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('title', $validator->getMessages(), 'event');

			return false;
		}
		return true;
	}

	public function validateDescription() {
		$validator = new Zend_Validate_StringLength(2);
		if(strlen($this->description) && !$validator->isValid($this->description)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('description', $validator->getMessages(), 'event');

			return false;
		}

		return true;
	}

	public function validateDateEvent() {
		if(!isset($this->dateEvent) || empty($this->dateEvent)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('dateEvent', array('required' => 'Datum is verplicht'), 'event');

			return false;
		}

		return true;
	}

	public function validateLocation() {
		$validator = new Zend_Validate_StringLength(2, 255);
		if(!$validator->isValid($this->location)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('location', $validator->getMessages(), 'event');

			return false;
		}
		$config = Zend_Registry::get('config');

		$client = new Zend_Http_Client('http://maps.google.com/maps/geo');
		$client->setParameterGet(array(
			'q' => $this->location,
			'output' => 'json',
			'oe' => 'utf8',
			'sensor' => 'false',
			'key' => $config->google->maps->apiKey
		));
		$response = Zend_Json::decode($client->request()->getBody());
		if($response['Status']['code'] != 200) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('location', array('invalidLocation' => 'Geen geldige locatie opgegeven'), 'event');

			return false;
		}
		if($response['Placemark'][0]['AddressDetails']['Accuracy'] < 6) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('location', array('invalidLocation' => 'Geen geldige locatie opgegeven of locatie is te algemeen'), 'event');

			return false;
		}

		return true;
	}

	public function validateMailRemember() {
		$validator = new Zend_Validate_StringLength(2);
		if(!$validator->isValid($this->mailRemember)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('mailRemember', $validator->getMessages(), 'mail');

			return false;
		}

		return true;
	}

	public function validateMailConfirmation() {
		$validator = new Zend_Validate_StringLength(2);
		if(!$validator->isValid($this->mailConfirmation)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('mailConfirmation', $validator->getMessages(), 'mail');

			return false;
		}

		return true;
	}

	public function validateDateStart() {
		if(!isset($this->dateStart) || empty($this->dateStart)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('dateStart', array('required' => 'Startdatum is verplicht'), 'settings');
			return false;
		}
		return true;
	}

	public function validateDateEnd() {
		$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
		if(!isset($this->dateEnd) || empty($this->dateEnd)) {
			$msg->addMessage('dateEnd', array('required' => 'Einddatum is verplicht'), 'settings');
			return false;
		}
		else {
			if(strtotime($this->dateEnd) < strtotime($this->dateStart)) {
				$msg->addMessage('dateEnd', array('lessthan' => 'Einddatum ligt voor begindatum'), 'settings');
				return false;
			}
		}
		return true;
	}

	public function validateRememberDays() {
		if(!$this->rememberDays) {
			$this->rememberDays = 0;
			return true;
		}

		$validator = new Zend_Validate_Int();
		if(!$validator->isValid($this->rememberDays)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Event');
			$msg->addMessage('rememberDays', $validator->getMessages(), 'settings');
			return false;
		}
		return true;
	}

	public function addFields(SxCms_Event_Field $field, $key = null) {
		if($key) {
			$this->_fields[$key] = $field;
		}
		else {
			$this->_fields[] = $field;
		}

		return $this;
	}

	public function removeFields($key) {
		foreach($this->_fields[$key]->getList() as $key1 => $list) {
			$this->_fields[$key]->removeList($key1);
		}

		unset($this->_fields[$key]);
		return $this;
	}

	public function getFields($key = null) {
		if($key) {
			return $this->_fields[$key];
		}

		return $this->_fields;
	}

	public function isValid() {
		if($this->isSubscriptionAllow()) {
			$this->validateDateStart();
			$this->validateDateEnd();
		}

		$this->validateRememberDays();
		$this->validateDateEvent();
		$this->validateLocation();
		$this->validateTitle();
		$this->validateDescription();
		$this->validateMailRemember();
		$this->validateMailConfirmation();

		return count(Sanmax_MessageStack::getInstance('SxCms_Event')->getNamespaceMessages()) == 0;
	}

	public function save() {
		$db = Zend_Registry::get('db');
		$config = Zend_Registry::get('config');
		$identity = Zend_Auth::getInstance()->getIdentity();

		/* save event */
		$eventData = array(
			'subscription_allow' => $this->isSubscriptionAllow(),
			'subscription_max' => (int)$this->getSubscriptionMax(),
			'notify_email' => $this->getNotifyEmail(),
			'date_start' => $this->getDateStart('%Y-%m-%d'),
			'date_end' => $this->getDateEnd('%Y-%m-%d'),
			'datetime_event' => $this->getDateEvent('%Y-%m-%d') . ' ' . $this->getTimeEvent('%H:%M:%S'),
			'location' => $this->getLocation(),
			'remember_days' => $this->getRememberDays(),
			'confirmation_link' => $this->isConfirmationLink(),
			'validate_intern' => $this->isValidateIntern()
		);

		if($this->getId() === false) {
			$event_id = $db->insert('Event', $eventData);
			$event_id = $db->lastInsertId();
		}
		else {

			$event_id = $this->getId();
			$db->update('Event', $eventData, 'event_id = ' . $event_id);
		}

		/* save tsl */
		$eventTsl = array(
			'event_id' => $event_id,
			'title' => $this->getTitle(),
			'description' => $this->getDescription(),
			'mail_remember' => $this->getMailRemember(),
			'mail_confirmation' => $this->getMailConfirmation()
		);

		if($this->getId() === false) {
			/*** Events hetzelfde NL/FR ***/
			/*foreach ($config->system->language as $lng => $slng) {
			 $eventTsl['language'] = $lng;
			 $db->insert('EventTsl', $eventTsl);
			 }*/

			/*** Events verschillend NL/FR ***/
			$system = new Zend_Session_Namespace('System');
			$eventTsl['language'] = $system->lng;
			$db->insert('EventTsl', $eventTsl);
		}
		else {
			$db->update('EventTsl', $eventTsl, 'event_id = ' . $this->getId() . ' AND language = \'' . $this->getLanguage() . '\'');
		}

		/* save fields */
		$tmpEvent = SxCms_Event_DataMapper::getEventById($this->getId());
		foreach($tmpEvent->getFields() as $field) {
			$field->delete();
		}

		if($this->getId() === false) {
			$lngs = $config->system->language;
		}
		else {
			$lngs[$this->getLanguage()] = null;
		}

		foreach($lngs as $lng => $slng) {
			foreach($this->getFields() as $field) {
				$field->setEventId($event_id);
				$field->setLanguage($lng);
				$field->save();
			}
		}

	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('EventTsl', 'event_id = ' . $this->getId() . ' AND language = \'' . $_SESSION['System']['lng'] . '\'');

		if(!SxCms_Event_DataMapper::isEventById($this->getId())) {
			$db->delete('Event', 'event_id = ' . $this->getId());
		}

		foreach($this->getFields() as $field) {
			$field->delete();
		}
	}
}