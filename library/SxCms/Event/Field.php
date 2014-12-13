<?php

class SxCms_Event_Field
{
	public $id;
	public $eventId;
	public $language;
	public $label;
	public $name;
	public $type;
	public $_list = array();

	public function setId($id) {
		$this->id = (int)$id;
		return $this;
	}
	public function getId() {
		return (int)$this->id;
	}

	public function setEventId($eventId) {
		$this->eventId = (int)$eventId;
		return $this;
	}
	public function getEventId() {
		return $this->eventId;
	}

	public function setLanguage($language) {
		$this->language = $language;
		return $this;
	}
	public function getLanguage() {
		return $this->language;
	}

	public function setLabel($label) {
		$this->label = $label;
		return $this;
	}
	public function getLabel() {
		return $this->label;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}

	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}

	public function addList(SxCms_Event_Field_List $list, $key = null) {
		if($key) {
			$this->_list[$key] = $list;
		}
		else {
			$this->_list[] = $list;
		}

		return $this;
	}

	public function removeList($key) {
		unset($this->_list[$key]);
		return $this;
	}

	public function getList($key = null) {
		if($key) {
			return $this->_list[$key];
		}
		else {
			return $this->_list;
		}
	}

	public function save() {
		$db = Zend_Registry::get('db');
		$identity = Zend_Auth::getInstance()->getIdentity();

		$fieldData = array(
			'event_id' => (int) $this->getEventId(),
			'language' => $this->getLanguage(),
			'label' => $this->getLabel(),
			'name' => $this->getName(),
			'type' => $this->getType()
		);

		if($this->getId()) {
			$fieldData['field_id'] = (int) $this->getId();
		}

		$db->insert('EventField', $fieldData);

		$eventFieldId = $db->lastInsertId();

		foreach($this->getList() as $list) {
			$list->setEventFieldId($eventFieldId);
			$list->save();
		}
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('EventField', 'field_id = ' . (int) $this->getId());

		foreach($this->getList() as $list) {
			$list->delete();
		}
	}
}