<?php

class SxCms_Event_Setting_DataMapper
{
	public function getAllSettings() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('e' => 'EventSettings'), array('*'))
			->where('e.language = ?', $_SESSION['System']['lng']);

		$results = $db->fetchAll($select);

		$settings = array();
		foreach($results as $result) {
			$setting = new SxCms_Event_Setting();
			$setting->setVariable($result['variable'])
				->setValue($result['value'])
				->setLanguage($result['language']);

			$settings[$result['variable']] = $setting;
		}

		return $settings;
	}
}