<?php

class SxModule_News_Mapper extends Base_Mapper
{
	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'nid' => array('type' => 'int', 'set' => 'setId'),
			'active' => array('type' => 'int', 'set' => 'setActive'),
			'lng' => array('type' => 'string', 'set' => 'setLng'),
			'url' => array('type' => 'string', 'set' => 'setUrl'),
			'title' => array('type' => 'string', 'set' => 'setTitle'),
			'summary' => array('type' => 'string', 'set' => 'setSummary'),
			'content' => array('type' => 'string', 'set' => 'setContent'),
			'seo_keywords' => array('type' => 'string', 'set' => 'setSeoKeywords'),
			'seo_description' => array('type' => 'string', 'set' => 'setSeoTitle'),
			'seo_title' => array('type' => 'string', 'set' => 'setSeoDescription'),
			'author_id' => array('type' => 'int', 'set' => 'setAuthorId'),
			'date_created' => array('type' => 'string', 'set' => 'setDateCreated'),
			'date_expired' => array('type' => 'string', 'set' => 'setDateExpired'),
			'date_published' => array('type' => 'string', 'set' => 'setDatePublished'),
			'date_updated' => array('type' => 'string', 'set' => 'setDateUpdated'),
			'picture' => array('type' => 'string', 'set' => 'setPicture')
		);
		
		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_News();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_News $item, $type = '*') {

        $identity = Zend_Auth::getInstance()->getIdentity();
		
		$data = array(
			'nid' => $item->getId(),
			'author_id' => $identity->getId(),
			'date_created' => $item->getDateCreated(),
			'date_published' => $item->getDatePublished(),
			'date_expired' => $item->getDateExpired(),
			'picture' => $item->getPicture()
		);

		$tsl = array(
			'lng' => $item->getLng(),
			'title' => $item->getTitle(),
			'summary' => $item->getSummary(),
			'content' => $item->getContent(),
			'url' => $item->_createUrl(),
			'seo_keywords' => $item->getSeoKeywords(),
			'seo_title' => $item->getSeoTitle(),
			'seo_description' => $item->getSeoDescription(),
			'active' => (int)$item->getActive()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}
}