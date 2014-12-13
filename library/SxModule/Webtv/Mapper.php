<?php

class SxModule_Webtv_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array('type' => 'int', 'set' => 'setId'),
			'author_id' => array('type' => 'int', 'set' => 'setAuthorId'),
			'date_created' => array('type' => 'string', 'set' => 'setDateCreated'),
			'date_updated' => array('type' => 'string', 'set' => 'setDateUpdated'),
			'date_published' => array('type' => 'string', 'set' => 'setDatePublished'),
			'youtube' => array('type' => 'string', 'set' => 'setYoutube'),
			'url' => array('type' => 'string', 'set' => 'setUrl'),
			'title' => array('type' => 'string', 'set' => 'setTitle'),
			'description' => array('type' => 'string', 'set' => 'setDescription'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'lng' => array('type' => 'string', 'set' => 'setLng')
		);
		
		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Webtv();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Webtv $item, $type = '*') {

        $identity = Zend_Auth::getInstance()->getIdentity();
		
		$data = array(
			'id' => $item->getId(),
			'author_id' => $identity->getId(),
			'date_created' => $item->getDateCreated(),
			'date_updated' => $item->getDateUpdated(),
			'date_published' => $item->getDatePublished(),
			'youtube' => $item->getYoutube()
		);

		$tsl = array(
			'url' => $item->getUrl(),
			'title' => $item->getTitle(),
			'description' => $item->getDescription(),
			'active' => $item->getActive(),
			'lng' => $item->getLng()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}
}
