<?php

class SxModule_Sheets_Subtype_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Sheets_Subtype_Mapper();
	}

	public function getAll($paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsSubtype'), array('*'))
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->order('ty.position ASC');

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

	public function getAllActive($cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsSubtype'), array('*'))
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('active = 1')
			->order('ty.position ASC');

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$types = array();
		foreach($results as $result) {
			$type = new SxModule_Sheets_Subtype();
			$type = $this->_mapper->toObject(is_array($result) ? $result : array());

			$proxy = new SxModule_Sheets_Proxy();
			$sheets = $proxy->getAllBySubtype($result['type_id']);
			$type->setSheets($sheets);

			$types[] = $type;
		}

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);

			$cache->save($data, $cacheId, $cacheTags);
		}

		return $types;
	}

	public function getTypeById($id, $lng = 'nl', $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsSubtype'), array('*'))
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
			->where('tyt.lng = ?', $lng)
			->where('ty.subtype_id = ?', (int) $id);

		$result = $db->fetchRow($select);

		$type = new SxModule_Sheets_Subtype();
		$type = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $id
			));

			$cache->save($type, $cacheId, $cacheTags);
		}

		return $type;
	}

	public function getAllByType($type, $lng = 'nl', $active = false, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		if($active == true) {

			$db = Zend_Registry::get('db');
			$select = $db->select()
				->from(array('ty' => 'SheetsSubtype'), array('*'))
				->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
				->where('tyt.lng = ?', $lng)
				->where('ty.type = ?', $type)
				->where('ty.active = ?', 1)
				->order('ty.position ASC');

		}

		else {

			$db = Zend_Registry::get('db');
			$select = $db->select()
				->from(array('ty' => 'SheetsSubtype'), array('*'))
				->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
				->where('tyt.lng = ?', $lng)
				->where('ty.type = ?', $type)
				->order('ty.position ASC');

		}

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

	public function getAllByTypeActive($type, $lng = 'nl', $active = false, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		if($active == true) {
			$db = Zend_Registry::get('db');
			$select = $db->select()
				->from(array('ty' => 'SheetsSubtype'), array('*'))
				->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
				->where('tyt.lng = ?', $lng)
				->where('ty.type = ?', $type)
				->where('ty.active = ?', 1)
				->order('ty.position ASC');
		}
		else {
			$db = Zend_Registry::get('db');
			$select = $db
				->select()
				->from(array('ty' => 'SheetsSubtype'), array('*'))
				->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
				->where('tyt.lng = ?', $lng)
				->where('ty.type = ?', $type)
				->order('ty.position ASC');
		}

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

	public function getAllBySubType($type, $cache = true) {
		$db = Zend_Registry::get('db');
		$select = $db
			->select()
			->from(array('ty' => 'SheetsSubtype'), array('*'))
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('*'))
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('ty.type = ?', $type)
			->where('active = 1')
			->order('ty.position ASC');

		$results = $db->fetchAll($select);

		$types = array();
		foreach($results as $result) {
			$type = new SxModule_Sheets_Subtype();
			$type = $this->_mapper->toObject(is_array($result) ? $result : array());

			$proxy = new SxModule_Sheets_Proxy();
			$sheets = $proxy->getAllBySubtype($result['subtype_id']);
			$type->setSheets($sheets);

			$types[] = $type;
		}

		return $types;
	}
}