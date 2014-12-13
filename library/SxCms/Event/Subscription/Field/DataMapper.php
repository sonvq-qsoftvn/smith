<?php

class SxCms_Event_Subscription_Field_DataMapper
{

	public function checkIfExists($field) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('subf' => 'EventSubscriptionField'), array('*'))
			->where('subf.subscription_id = ?', (int) $field->getSubscriptionId())
			->where('subf.field_id = ?', (int) $field->getFieldId());

		$result = $db->fetchRow($select);

		if($result) return true;
		else return false;
	}
}