<?php

class SxCms_Event_Subscription_Field
{

	public $subscriptionId;
	public $fieldId;
	public $name;
	public $value;
	public $_list = array();

	public function setSubscriptionId($subscriptionId) {
		$this->subscriptionId = (int)$subscriptionId;
		return $this;
	}
	public function getSubscriptionId() {
		return $this->subscriptionId;
	}

	public function setFieldId($fieldId) {
		$this->fieldId = (int)$fieldId;
		return $this;
	}
	public function getFieldId() {
		return $this->fieldId;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}

	public function save() {
		$db = Zend_Registry::get('db');

		$fieldData = array(
			'subscription_id' => (int) $this->getSubscriptionId(),
			'field_id' => (int) $this->getFieldId(),
			'name' => $this->getName(),
			'value' => $this->getValue()
		);

		$db->insert('EventSubscriptionField', $fieldData);
	}

	public function update() {
		$db = Zend_Registry::get('db');
		$fieldData = array('value' => $this->getValue());

		$db->update('EventSubscriptionField', $fieldData, 'subscription_id = ' . (int) $this->getSubscriptionId() . ' AND field_id = ' . (int) $this->getFieldId());
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('EventField', 'field_id = ' . (int) $this->getId());

		foreach($this->getList() as $list) {
			$list->delete();
		}
	}
}