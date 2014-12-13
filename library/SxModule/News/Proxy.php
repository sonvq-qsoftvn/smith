<?php

class SxModule_News_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_News_Mapper();
	}

	public function controlNews($id, $lng) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('NewsTsl', array('*'))
			->where('nid = ?', (int) $id)
			->where('lng = ?', $lng);

		$result = $db->fetchRow($select);

		if($result) return $result;
		else return false;
	}

	public function getById($nid, $lng, $active = false, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('n' => 'News'), array('*'))
			->joinLeft(array('t' => 'NewsTsl', array(
				'lng', 'title', 'summary', 'content', 'url', 'seo_keywords', 'seo_title', 'seo_description', 'active'
			)), 'n.nid = t.nid')
			->where('n.nid = ?', (int) $nid)
			->where('t.lng = ?', $lng);

		if($active) $select->where('t.active = 1');

		$result = $db->fetchRow($select);
		$data = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $nid
			));

			$cache->save($data, $cacheId, $cacheTags);
		}

		return $data;
	}

	public function search($search, $active = false, $lng = 'nl', $paginator = true, $pindex = 1, $perpage = 25) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('n' => 'News'), array('*'))
			->joinLeft(array('t' => 'NewsTsl', array(
				'lng', 'title', 'summary', 'content', 'url', 'seo_keywords', 'seo_title', 'seo_description', 'active'
			)), 'n.nid = t.nid')
			->where('t.title LIKE '.$db->quote('%'.$search.'%').' OR t.content LIKE '.$db->quote('%'.$search.'%'))
			->where('t.lng = ?', $lng);

		if($active) {
			$select->where('t.active = 1')
				->where('n.date_published <= NOW()')
				->where('n.date_expired > NOW() OR n.date_expired is NULL')
				->order('n.date_published ASC');
		}
		else {
			$select->order('n.date_published ASC')->order('n.date_created ASC');
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

		return $data;
	}

	public function getAll($active = false, $lng = 'nl', $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('n' => 'News'), array('*'))
			->joinLeft(array('t' => 'NewsTsl', array(
				'lng', 'title', 'summary', 'content', 'url', 'seo_keywords', 'seo_title', 'seo_description', 'active'
			)), 'n.nid = t.nid')
			->where('t.lng = ?', $lng);

		if($active) {
			$select->where('t.active = 1')
				->where('n.date_published <= NOW()')
				->where('n.date_expired > NOW() OR n.date_expired is NULL')
				->order('n.date_published DESC');
		}
		else {
			$select->order('n.date_published DESC')->order('n.date_created DESC');
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
}