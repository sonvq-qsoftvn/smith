<?php

class SxModule_Subscribe_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'name' => array('type' => 'string', 'set' => 'setName'),
			'firstname' => array('type' => 'string', 'set' => 'setFirstname'),
			'email' => array('type' => 'string', 'set' => 'setEmail'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Subscribe();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Subscribe $item) {
		$data = array(
			'id' => $item->getId(),
			'lng' => $item->getLng(),
			'name' => $item->getName(),
			'firstname' => $item->getFirstname(),
			'email' => $item->getEmail(),
			'active' => $item->getActive()
		);

		return $data;
	}
}