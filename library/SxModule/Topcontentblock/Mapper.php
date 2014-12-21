<?php

class SxModule_Topcontentblock_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'blockname' => array('type' => 'string', 'set' => 'setBlockname'),
			'b_id' => array('type' => 'int', 'set' => 'setId'),
			'title' => array('type' => 'string', 'set' => 'setTitle'),
			'content' => array('type' => 'string', 'set' => 'setContent'),
			'url' => array('type' => 'string', 'set' => 'setUrl'),
			'picture' => array('type' => 'string', 'set' => 'setPicture'),
            'thumb' => array('type' => 'string', 'set' => 'setThumb'),
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Topcontentblock();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Topcontentblock $item, $type = '*') {
		$data = array('blockname' => $item->getBlockname());

		$tsl = array(
			'lng' => $item->getLng(),
			'title' => $item->getTitle(),
			'content' => $item->getContent(),
			'url' => $item->getUrl(),
			'picture' => $item->getPicture(),
            'thumb' => $item->getThumb()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}
}
