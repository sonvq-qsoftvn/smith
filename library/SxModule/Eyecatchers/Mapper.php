<?php

class SxModule_Eyecatchers_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'tsl_id' => array('type' => 'int', 'set' => 'setTslId'),
			'date_created' => array('type' => 'string', 'set' => 'setDateCreated'),
			'date_updated' => array('type' => 'string', 'set' => 'setDateUpdated'),
			'picture' => array('type' => 'string', 'set' => 'setPicture'),
			'place' => array('type' => 'string', 'set' => 'setPlace'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'url' => array('type' => 'string', 'set' => 'setUrl'),
			'title' => array('type' => 'string', 'set' => 'setTitle'),
			'subtitle' => array('type' => 'string', 'set' => 'setSubtitle')
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Eyecatchers();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Eyecatchers $item, $type = '*') {
		$data = array(
			'id' => $item->getId(),
			'date_created' => $item->getDateCreated(),
			'date_updated' => $item->getDateUpdated(),
			'picture' => $item->getPicture(),
			'place' => $item->getPlace(),
			'active' => $item->getActive()
		);

		$tsl = array(
			'tsl_id' => $item->getTslId(),
			'lng' => $item->getLng(),
			'url' => $item->getUrl(),
			'title' => $item->getTitle(),
			'subtitle' => $item->getSubtitle()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}
}