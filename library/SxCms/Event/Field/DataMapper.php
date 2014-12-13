<?php

class SxCms_Event_Field_DataMapper
{
	public function getFieldByEvent(SxCms_Event $event)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('EventField', array('*'))
			->where('event_id = ?', $event->getId())
			->where('language = ?', $event->getLanguage());
		
		
	
		$results = $db->fetchAll($select);

		foreach($results as $result) {
			
			$eventfield = new SxCms_Event_Field();
			$eventfield->setId($result['field_id'])
                ->setEventId($result['event_id'])
                ->setLanguage($result['language'])
                ->setLabel($result['label'])
                ->setName($result['name'])
                ->setType($result['type']);
            
			$event->addFields($eventfield, $result['field_id']);
		
			$proxy = new SxCms_Event_Field_List_DataMapper();
			$proxy->getListByField($eventfield);
		}

		return ;
	}
	
	public function getFieldsByEvent($event_id)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('EventField', array('*'))
			->where('event_id = ?', $event_id);
	
		$results = $db->fetchAll($select);

		$fields = array();
		foreach($results as $result) {
			
			$eventfield = new SxCms_Event_Field();
			$eventfield->setId($result['field_id'])
                ->setEventId($result['event_id'])
                ->setLanguage($result['language'])
                ->setLabel($result['label'])
                ->setName($result['name'])
                ->setType($result['type']);
            
			$fields[] = $eventfield;
		}

		return $fields;
	}
}
