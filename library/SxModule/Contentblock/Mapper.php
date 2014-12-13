<?php

class SxModule_Contentblock_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'tsl_id' => array('type' => 'int', 'set' => 'setTslId'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'blockname' => array('type' => 'string', 'set' => 'setBlockname'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'title' => array('type' => 'string', 'set' => 'setTitle'),
			'content' => array('type' => 'string', 'set' => 'setContent')
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) {
			$instance = new SxModule_Contentblock();
		}

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Contentblock $item, $type = '*') {
		$data = array(
			'id' => $item->getId(),
			'blockname' => $item->getBlockname(),
			'active' => $item->getActive()
		);

		$tsl = array(
			'tsl_id' => $item->getTslId(),
			'lng' => $item->getLng(),
			'title' => $item->getTitle(),
			'content' => $item->getContent()
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