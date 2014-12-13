<?php

class SxModule_Webtv_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Webtv_Mapper();
	}

	public function getAll($lng = 'nl', $active = false, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'WebTv'), array('*'))
			->join(array('t' => 'WebTvTsl'), 'a.id = t.webtv_id', array(
				'url', 'lng', 'title', 'description', 'active'
			))->where('t.lng = ?', $lng)
			->order('a.date_published DESC');

		if($active) $select->where('t.active = 1')->where('a.date_published <= CURDATE()');

		if($paginator === true) {
			$adapter = new Base_PaginatorAdapter($select);
			$adapter->setMapper($this->_mapper);

			$data = new Zend_Paginator($adapter);
			$data->setCurrentPageNumber((int)$pindex);
			$data->setItemCountPerPage((int)$perpage);
		}
		else {
			$results = $db->fetchAll($select);
			$data = $this->_mapper->mapAll($results);
		}

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);
			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}

	public function getById($id, $lng = 'nl', $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'WebTv'), array('*'))
			->join(array('t' => 'WebTvTsl'), 'a.id = t.webtv_id', array('url', 'lng', 'title', 'description', 'active'))
			->where('t.lng = ?', $lng)
			->where('a.id = ?', $id);

		$result = $db->fetchRow($select);
		$data = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);

			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}

	public function controlId($id, $lng = 'nl') {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('WebTvTsl', array('*'))
			->where('webtv_id = ?', (int) $id)
			->where('lng = ?', $lng);

		$result = $db->fetchRow($select);

		if($result) return $result;
		else return false;
	}
}