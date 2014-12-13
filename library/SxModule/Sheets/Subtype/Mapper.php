<?php

class SxModule_Sheets_Subtype_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'subtype_id' => array('type' => 'int', 'set' => 'setId'),
			'name' => array('type' => 'string', 'set' => 'setName'),
			'type' => array('type' => 'string', 'set' => 'setType'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'position' => array('type' => 'int', 'set' => 'setPosition')
		);
		
		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Sheets_Subtype();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Sheets_Subtype $item, $type = '*') {
		$data = array(
			'subtype_id' => $item->getId(),
			'active' => $item->getActive(),
			'position' => $item->getPosition()
		);

		$tsl = array(
			'lng' => $item->getLng(),
			'name' => $item->getName()
		);

		if($type == 'item') {
			return $data;
		}
		elseif($type == 'tsl') {
			return $tsl;
		}

		return array_merge($data, $tsl);
	}
}