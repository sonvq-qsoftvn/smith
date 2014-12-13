<?php

class SxCms_Event_Field_List
{
	public $_id;
	public $_eventFieldId;
	public $_label;
	public $_value;

	public function setId($id) {
		$this->_id = (int)$id;
		return $this;
	}
	public function getId() {
		return (int)$this->_id;
	}

	public function setEventFieldId($eventFieldId) {
		$this->_eventFieldId = (int)$eventFieldId;
		return $this;
	}
	public function getEventFieldId() {
		return $this->_eventFieldId;
	}

	public function setLabel($label) {
		$this->_label = $label;
		return $this;
	}
	public function getLabel() {
		return $this->_label;
	}

	public function setValue($value) {
		$this->_value = $value;
		return $this;
	}
	public function getValue() {
		return $this->_value;
	}

	public function save() {
		$db = Zend_Registry::get('db');
		$identity = Zend_Auth::getInstance()->getIdentity();

		$listData = array(
			'event_field_id' => (int) $this->getEventFieldId(),
			'label' => $this->getLabel(),
			'value' => $this->getValue(),
		);

		if($this->getId()) {
			$listData['list_id'] = (int)$this->getId();
		}

		$db->insert('EventFieldList', $listData);
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('EventFieldList', 'list_id = ' . (int) $this->getId());
	}
}