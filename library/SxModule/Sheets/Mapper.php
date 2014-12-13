<?php

class SxModule_Sheets_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'type' => array('type' => 'int', 'set' => 'setType'),
			'typename' => array('type' => 'string', 'set' => 'setTypeName'),
			'subtype' => array('type' => 'int', 'set' => 'setSubType'),
			'subtypename' => array('type' => 'string', 'set' => 'setSubTypeName'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'name' => array('type' => 'string', 'set' => 'setName'),
			'desc' => array('type' => 'string', 'set' => 'setDesc'),
			't_file' => array('type' => 'string', 'set' => 'setFile'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'place' => array('type' => 'string', 'set' => 'setPlace'),
			'date_created' => array('type' => 'string', 'set' => 'setDateCreated'),
			'date_updated' => array('type' => 'string', 'set' => 'setDateUpdated')
		);
		
		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Sheets();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Sheets $item, $type = '*') {
		$data = array(
			'type' => $item->getType(),
			'subtype' => $item->getSubtype(),
			'active' => $item->getActive(),
			'place' => $item->getPlace(),
			'date_created' => $item->getDateCreated(),
			'date_updated' => $item->getDateUpdated()
		);

		$tsl = array(
			'name' => $item->getName(),
			't_desc' => $item->getDesc(),
			't_file' => $item->getFile(),
			'lng' => $item->getLng()
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
