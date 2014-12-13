<?php

class SxModule_Members_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'sex' => array('type' => 'string', 'set' => 'setSex'),
			'name' => array('type' => 'string', 'set' => 'setName'),
			'first_name' => array('type' => 'string', 'set' => 'setFirstName'),
			'company' => array('type' => 'string', 'set' => 'setCompany'),
			'website' => array('type' => 'string', 'set' => 'setWebsite'),
			'email' => array('type' => 'string', 'set' => 'setEmail'),
			'password' => array('type' => 'string', 'set' => 'setPassword'),
			'phone' => array('type' => 'string', 'set' => 'setPhone'),
			'fax' => array('type' => 'string', 'set' => 'setFax'),
			'mobile_phone' => array('type' => 'string', 'set' => 'setMobilePhone'),
			'street' => array('type' => 'string', 'set' => 'setStreet'),
			'number' => array('type' => 'string', 'set' => 'setNumber'),
			'postalcode' => array('type' => 'string', 'set' => 'setPostalcode'),
			'place' => array('type' => 'string', 'set' => 'setPlace'),
			'country' => array('type' => 'string', 'set' => 'setCountry'),
			'boardMember' => array('type' => 'string', 'set' => 'setBoardMember'),
			'groups' => array('type' => 'string', 'set' => 'setGroups'),
			'date_created' => array('type' => 'string', 'set' => 'setDateCreated'),
			'date_updated' => array('type' => 'string', 'set' => 'setDateUpdated')
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Members();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Members $item, $type = '*') {
		$data = array(
			'id' => (int)$item->getId(),
			'active' => (int)$item->getActive(),
			'lng' => $item->getLng(),
			'sex' => $item->getSex(),
			'name' => $item->getName(),
			'first_name' => $item->getFirstName(),
			'company' => $item->getCompany(),
			'website' => $item->getWebsite(),
			'email' => $item->getEmail(),
			'password' => $item->getPassword(),
			'phone' => $item->getPhone(),
			'fax' => $item->getFax(),
			'mobile_phone' => $item->getMobilePhone(),
			'street' => $item->getStreet(),
			'number' => $item->getNumber(),
			'postalcode' => $item->getPostalcode(),
			'place' => $item->getPlace(),
			'country' => $item->getCountry(),
			'board_member' => (int)$item->getBoardMember(),
			'date_created' => $item->getDateCreated(),
			'date_updated' => $item->getDateUpdated()
		);

		return $data;
	}
}