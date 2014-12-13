<?php

class SxModule_Sheets_Type_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Sheets_Type_Mapper();
	}

	public function getAll($lng = 'nl', $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsType'), array('*'))
			->join(array('tyt' => 'SheetsTypeTsl'), 'ty.type_id = tyt.type_id', array('*'))
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

		$proxy = new SxModule_Sheets_Subtype_Proxy();
		$subtypes = $proxy->getAll();

		foreach($data as $type) {
			foreach($subtypes as $subtype) {
				if($type->getId() == $subtype->getType()) {
					$type->addSubtype($subtypes);
				}
			}
		}

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);

			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}

	public function getAllActive($lng = 'nl', $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsType'), array('*'))
			->join(array('tyt' => 'SheetsTypeTsl'), 'ty.type_id = tyt.type_id', array('*'))
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('ty.active = ?', 1)
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

		$proxy = new SxModule_Sheets_Subtype_Proxy();
		$subtypes = $proxy->getAll();

		foreach($data as $type) {
			foreach($subtypes as $subtype) {
				if($type->getId() == $subtype->getType()) {
					$type->addSubtype($subtypes);
				}
			}
		}

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__);

			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}

	public function getTypeById($id, $lng, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'SheetsType'), array('*'))
			->join(array('tyt' => 'SheetsTypeTsl'), 'ty.type_id = tyt.type_id', array('*'))
			->where('tyt.lng = ?', $lng)
			->where('ty.type_id = ?', (int) $id);

		$result = $db->fetchRow($select);

		$type = new SxModule_Sheets_Type();
		$type = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $id
			));

			$cache->save($type, $cacheId, $cacheTags);
		}

		return $type;
	}
}