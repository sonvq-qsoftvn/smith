<?php

class SxModule_Eyecatchers_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Eyecatchers_Mapper();
	}

	public function getById($id, $lng = 'nl', $active = false, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Eyecatchers'), array('a.*'))
			->join(array('t' => 'EyecatchersTsl'), 'a.id = t.e_id', array('t.*'))
			->where('a.id = ?', (int) $id)
			->where('t.lng = ?', $lng);

		if($active) $select->where('a.active = 1');

		$result = $db->fetchRow($select);
		$item = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $id
			));
			$cache->save($item, $cacheId, $cacheTags);
		}

		return $item;
	}

	public function getAll($lng, $active = false, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Eyecatchers'), array('a.*'))
			->join(array('t' => 'EyecatchersTsl'), 'a.id = t.e_id', array('t.*'))
			->where('t.lng = ?', $lng)
			->order('a.place ASC');

		if($active) $select->where('a.active = 1');

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
}