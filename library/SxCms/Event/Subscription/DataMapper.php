<?php

class SxCms_Event_Subscription_DataMapper
{

	public function getSubscriptionById($subscription_id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('sub' => 'EventSubscription'), array('*'))
			->where('sub.subscription_id = ?', (int) $subscription_id);

		$result = $db->fetchRow($select);

		$subscription = new SxCms_Event_Subscription();
		$subscription->setSubscriptionId((int) $result['subscription_id'])
			->setEventId((int) $result['event_id'])
			->setStatus($result['status']);

		$select = $db->select()
			->from(array('field' => 'EventSubscriptionField'), array('*'))
			->where('field.subscription_id = ?', (int) $result['subscription_id']);

		$fields = $db->fetchAll($select);
		foreach($fields as $field) {
			$subscription->addFields($field['name'], $field['value']);
		}

		return $subscription;
	}

	public function getSubscriptionsForEvent($event_id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('sub' => 'EventSubscription'), array('*'))
			->where('sub.event_id = ?', (int) $event_id);

		$results = $db->fetchAll($select);

		$subscriptions = array();
		foreach($results as $result) {
			$db = Zend_Registry::get('db');
			$select = $db->select()
				->from(array('field' => 'EventSubscriptionField'), array('*'))
				->where('field.subscription_id = ?', (int) $result['subscription_id']);

			$fields = $db->fetchAll($select);
			foreach($fields as $field) {
				$result[$field['name']] = $field['value'];
			}
			$subscriptions[] = $result;
		}

		return $subscriptions;
	}

	public function getValidSubscriptionsForEvent($event_id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('sub' => 'EventSubscription'), array('*'))
			->where('sub.event_id = ?', (int) $event_id)
			->where('status = 1');

		$results = $db->fetchAll($select);

		$subscriptions = array();
		foreach($results as $result) {
			$db = Zend_Registry::get('db');
			$select = $db->select()
				->from(array('field' => 'EventSubscriptionField'), array('*'))
				->where('field.subscription_id = ?', (int) $result['subscription_id']);

			$fields = $db->fetchAll($select);
			foreach($fields as $field) {
				$result[$field['name']] = $field['value'];
			}
			$subscriptions[] = $result;
		}

		return $subscriptions;
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
}