<?php

class SxModule_Sheets_Type_Mapper extends Base_Mapper
{
	
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'type_id' => array('type' => 'int', 'set' => 'setId'),
			'name' => array('type' => 'string', 'set' => 'setName'),
			'scheme' => array('type' => 'string', 'set' => 'setScheme'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'position' => array('type' => 'int', 'set' => 'setPosition')
		);
		
		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Sheets_Type();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Sheets_Type $item, $type = '*') {
		$data = array(
			'type_id' => $item->getId(),
			'scheme' => $item->getScheme(),
			'active' => $item->getActive(),
			'position' => $item->getPosition()
		);

		$tsl = array(
			'lng' => $item->getLng(),
			'name' => $item->getName()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}
}
