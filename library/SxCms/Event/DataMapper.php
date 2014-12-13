<?php

class SxCms_Event_DataMapper
{
	public function isEventById($event_id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('e' => 'EventTsl'), array('count(*) AS aantal'))
			->where('e.event_id = ?', (int) $event_id);

		$result = $db->fetchRow($select);
		if($result['aantal'] > 0) {
			return true;
		}

		return false;
	}

	public function getDistinctRegions() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Event', array('DISTINCT(location) AS region'))
			->order('location ASC');

		$result = $db->fetchAll($select);

		$regions = array();
		foreach($result as $region) {
			$address = new SxCms_Address();
			$address->setRegion($region['region']);

			$regions[] = $address;
		}

		return $regions;
	}

	public function getEventById($event_id) {
		$lng = isset($_SESSION['System']['lng']) ? $_SESSION['System']['lng'] : 'nl';

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('e' => 'Event'), array('*'))
			->join(array('t' => 'EventTsl'), 'e.event_id = t.event_id', array( 'language', 'title', 'description', 'mail_remember', 'mail_confirmation' ))
			->where('e.event_id = ?', (int) $event_id)
			->where('t.language = ?', $lng);

		$results = $db->fetchAll($select);

		if(!$results) {
			return false;
		}
		$result = $results[0];

		$date = explode(' ', $result['datetime_event']);

		$event = new SxCms_Event();
		$event->setId((int) $result['event_id'])
			->setLanguage($result['language'])
			->setTitle($result['title'])
			->setDescription($result['description'])
			->setDateEvent($date[0])
			->setTimeEvent($date[1])
			->setLocation($result['location'])
			->setMailRemember($result['mail_remember'])
			->setMailConfirmation($result['mail_confirmation'])
			->setSubscriptionAllow($result['subscription_allow'])
			->setSubscriptionMax($result['subscription_max'])
			->setNotifyEmail($result['notify_email'])
			->setDateStart($result['date_start'])
			->setDateEnd($result['date_end'])
			->setRememberDays($result['remember_days'])
			->setConfirmationLink($result['confirmation_link'])
			->setValidateIntern($result['validate_intern']);

		$proxy = new SxCms_Event_Field_DataMapper();
		$proxy->getFieldByEvent($event);

		return $event;
	}

	public function getNextEvents($limit = 5) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
		->from(array('e' => 'Event'), array('*'))
		->join(array('t' => 'EventTsl'), 'e.event_id = t.event_id', array( 'language', 'title', 'description', 'mail_remember', 'mail_confirmation' ))
		->where('t.language = ?', $_SESSION['System']['lng'])
		->where('e.datetime_event >= ' . $db->quote( date('Y-m-d H:i:s') ))
		->order('datetime_event');

		if($limit) {
			$select->limit($limit);
		}

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$events = array();
		foreach($results as $result) {
			$date = explode(' ', $result['datetime_event']);

			$event = new SxCms_Event();
			$event->setId((int) $result['event_id'])
				->setLanguage($result['language'])
				->setTitle($result['title'])
				->setDescription($result['description'])
				->setDateEvent($date[0])
				->setTimeEvent($date[1])
				->setLocation($result['location'])
				->setMailRemember($result['mail_remember'])
				->setMailConfirmation($result['mail_confirmation'])
				->setSubscriptionAllow($result['subscription_allow'])
				->setSubscriptionMax($result['subscription_max'])
				->setDateStart($result['date_start'])
				->setDateEnd($result['date_end'])
				->setRememberDays($result['remember_days'])
				->setConfirmationLink($result['confirmation_link'])
				->setValidateIntern($result['validate_intern']);

			$events[] = $event;
		}

		return $events;
	}

	public function getAllEvents() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('e' => 'Event'), array('*'))
			->join(array('t' => 'EventTsl'), 'e.event_id = t.event_id', array( 'language', 'title', 'description', 'mail_remember', 'mail_confirmation' ))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->order('datetime_event');

		$results = $db->fetchAll($select);

		$events = array();
		foreach($results as $result) {
			$date = split(' ', $result['datetime_event']);

			$event = new SxCms_Event();
			$event->setId((int) $result['event_id'])
				->setLanguage($result['language'])
				->setTitle($result['title'])
				->setDescription($result['description'])
				->setDateEvent($date[0])
				->setTimeEvent($date[1])
				->setLocation($result['location'])
				->setMailRemember($result['mail_remember'])
				->setMailConfirmation($result['mail_confirmation'])
				->setSubscriptionAllow($result['subscription_allow'])
				->setSubscriptionMax($result['subscription_max'])
				->setDateStart($result['date_start'])
				->setDateEnd($result['date_end'])
				->setRememberDays($result['remember_days'])
				->setConfirmationLink($result['confirmation_link'])
				->setValidateIntern($result['validate_intern']);

			$events[] = $event;
		}

		return $events;
	}

	public function getPrevEvents() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('e' => 'Event'), array('*'))
			->join(array('t' => 'EventTsl'), 'e.event_id = t.event_id', array( 'language', 'title', 'description', 'mail_remember', 'mail_confirmation' ))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('e.datetime_event < ' . $db->quote( date('Y-m-d H:i:s') ))
			->order('datetime_event');

		$results = $db->fetchAll($select);

		$events = array();
		foreach($results as $result) {
			$date = explode(' ', $result['datetime_event']);

			$event = new SxCms_Event();
			$event->setId((int) $result['event_id'])
				->setLanguage($result['language'])
				->setTitle($result['title'])
				->setDescription($result['description'])
				->setDateEvent($date[0])
				->setTimeEvent($date[1])
				->setLocation($result['location'])
				->setMailRemember($result['mail_remember'])
				->setMailConfirmation($result['mail_confirmation'])
				->setSubscriptionAllow($result['subscription_allow'])
				->setSubscriptionMax($result['subscription_max'])
				->setDateStart($result['date_start'])
				->setDateEnd($result['date_end'])
				->setRememberDays($result['remember_days'])
				->setConfirmationLink($result['confirmation_link'])
				->setValidateIntern($result['validate_intern']);

			$events[] = $event;
		}

		return $events;
	}
}