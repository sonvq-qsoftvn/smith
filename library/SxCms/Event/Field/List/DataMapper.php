<?php

class SxCms_Event_Field_List_DataMapper
{
	public function getListByField(SxCms_Event_Field &$field)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('EventFieldList', array('*'))
			->where('event_field_id = ?', $field->getId());

		$results = $db->fetchAll($select);

		foreach($results as $result) {
			$fieldlist = new SxCms_Event_Field_List();
			$fieldlist->setId($result['list_id'])
                ->setEventFieldId($result['event_field_id'])
                ->setLabel($result['label'])
                ->setValue($result['value']);

			$field->addList($fieldlist, $result['list_id']);
		}

		return;
	}
}