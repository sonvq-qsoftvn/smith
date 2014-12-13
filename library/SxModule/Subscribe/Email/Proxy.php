<?php

class SxModule_Subscribe_Email_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Subscribe_Email_Mapper();
	}

	public function getById($id, $lng = 'nl') {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'SubscribeMail'), array('*'))
			->join(array('t' => 'SubscribeMailTsl'), 'a.id = t.mail_id', array( 'lng', 'subject', 'content' ))
			->where('t.lng = ?', $lng)
			->where('a.id = ?', (int) $id);

		$result = $db->fetchRow($select);
		$item = $this->_mapper->toObject(is_array($result) ? $result : array());

		return $item;
	}

	public function getAll($lng = 'nl', $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId)))
				return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'SubscribeMail'), array('*'))
			->join(array('t' => 'SubscribeMailTsl'), 'a.id = t.mail_id', array( 'lng', 'subject', 'content' ))
			->where('t.lng = ?', $lng)
			->order('a.id ASC');

		$results = $db->fetchAll($select);
		$data = $this->_mapper->mapAll($results);

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);
			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}
}