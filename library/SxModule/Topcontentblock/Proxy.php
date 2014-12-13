<?php

class SxModule_Topcontentblock_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Topcontentblock_Mapper();
	}

	public function getById($id, $lng = 'nl', $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'TopcontentBlocks'), array('a.*'))
			->join(array('t' => 'TopcontentBlocksTsl'), 'a.id = t.b_id', array('t.*'))
			->where('a.id = ?', (int) $id)
			->where('t.lng = ?', $lng);
		
		$result = $db->fetchRow($select);
		
		$block = new SxModule_Topcontentblock();
		$block = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . $id
			));
			$cache->save($block, $cacheId, $cacheTags);
		}

		return $block;
	}

	public function getByBlockname($blockname, $lng = 'nl') {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'TopcontentBlocks'), array('a.*'))
			->join(array('t' => 'TopcontentBlocksTsl'), 'a.id = t.b_id', array('t.*'))
			->where('a.blockname = ?', $blockname)
			->where('t.lng = ?', $lng);

		$result = $db->fetchRow($select);

		$block = new SxModule_Topcontentblock();
		$block = $this->_mapper->toObject(is_array($result) ? $result : array());

		return $block;
	}

	public function getAll($lng, $paginator = true, $pindex = 1, $perpage = 1, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'TopcontentBlocks'), array('a.*'))
			->join(array('t' => 'TopcontentBlocksTsl'), 'a.id = t.b_id', array('t.*'))
			->where('t.lng = ?', $lng);

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
