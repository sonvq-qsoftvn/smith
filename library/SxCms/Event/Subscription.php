<?php

class SxCms_Event_Subscription
{
	public $subscriptionId;
	public $eventId;
	public $status;
	protected $_fields = array();

	public function setSubscriptionId($id) {
		$this->id = (int)$id;
		return $this;
	}
	public function getSubscriptionId() {
		return (int)$this->id;
	}

	public function setEventId($eventId) {
		$this->eventId = (int)$eventId;
		return $this;
	}
	public function getEventId() {
		return $this->eventId;
	}

	public function setStatus($status) {
		$this->status = (int)$status;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}

	public function addFields($key = null, $value = '') {
		if($key) {
			$this->_fields[$key] = $value;
		}
		else {
			$this->_fields[] = $field;
		}

		return $this;
	}

	public function removeFields($key) {

		unset($this->_fields[$key]);
		return $this;
	}

	public function getFields($key = null) {
		if($key) {
			if(isset($this->_fields[$key]))
				return $this->_fields[$key];
			else
				return '';
		}

		return $this->_fields;
	}

	public function save() {
		$db = Zend_Registry::get('db');
		
		$subData = array(
			'event_id' => (int) $this->getEventId(),
			'status' => $this->getStatus()
		);

		if($this->getSubscriptionId()) {
			$db->update('EventSubscription', $subData, 'subscription_id = ' . (int) $this->getSubscriptionId());
		}
		else {
			$db->insert('EventSubscription', $subData);
		}

		return $db->lastInsertId();
	}

	public function sendConfirmation() {
		$eventProxy = new SxCMS_Event_DataMapper();
		$event = $eventProxy->getEventById($this->getEventId());

		$mail = new Zend_Mail('utf-8');
		$mail->setSubject('Bevestiging inschrijving')
			->setFrom('info@klav.be', 'KLAV');

		$body = $event->getMailConfirmation();

		$mail->setBodyHtml($body);
		$mail->addTo('thieusmith@gmail.com');
		return $mail->send();

	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('EventSubscription', 'subscription_id = ' . $this->getSubscriptionId());
		$db->delete('EventSubscriptionField', 'subscription_id = ' . $this->getSubscriptionId());
	}
}