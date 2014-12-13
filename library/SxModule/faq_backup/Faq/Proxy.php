<?php

class SxModule_Faq_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Faq_Mapper();
	}

	public function getAll($paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');

			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->join(array('ty' => 'FaqType'), 'a.type = ty.id', array())
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('name'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('tyt.language = ?', $_SESSION['System']['lng'])
			->order('a.type')
			->order('a.id desc');

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

	public function search($lng = 'nl', $active = null, $search) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->join(array('ty' => 'FaqType'), 'a.type = ty.id', array())
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('name'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('tyt.language = ?', $_SESSION['System']['lng'])
			->order('a.type')
			->order('a.id desc')
			->group('a.type');

		if($active != null) $select->where('a.active = ?', $db->quote($active));

		foreach($search as $s) {
			$select->where("t.question LIKE '%" . $s . "%' OR t.answer LIKE '%" . $s . "%'");
		}

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$types = array();
		foreach($results as $result) {
			$typeProxy = new SxModule_Faq_Type_Proxy();
			$type = $typeProxy->getTypeById($result['type']);
			$types[] = $type;
		}

		return $types;
	}

	public function getAllByType($type) {
		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->join(array('ty' => 'FaqType'), 'a.type = ty.id', array())
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('name'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('tyt.language = ?', $_SESSION['System']['lng'])
			->where('a.type = ?', $type)
			->order('a.type')
			->order('a.id desc');

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$faqs = array();
		foreach($results as $result) {
			$faq = new SxModule_Faq();
			$this->_mapper->mapAll($results);

			$faqs[] = $faq;
		}

		return $faqs;
	}

	public function getAllActiveByType($type) {
		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->join(array('ty' => 'FaqType'), 'a.type = ty.type_id', array())
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.type_id = tyt.type_id', array('name'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('tyt.language = ?', $_SESSION['System']['lng'])
			->where('a.active = 1')
			->where('a.type = ?', $type)
			->order('a.type')
			->order('a.id desc');

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$faqs = array();
		foreach($results as $result) {
			$faq = new SxModule_Faq();
			$faq = $this->_mapper->toObject(is_array($result) ? $result : array());

			$faqs[] = $faq;
		}

		return $faqs;
	}

	public function getAllActive() {
		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('a.active = 1')
			->order('a.id desc');

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$faqs = array();
		foreach($results as $result) {
			$faq = new SxModule_Faq();
			$faq = $this->_mapper->toObject(is_array($result) ? $result : array());
			$faqs[] = $faq;
		}

		return $faqs;
	}

	public function getById($id, $lng, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()->from(array('a' => 'Faq'), array('*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.faq_id', array('language','question','answer'))
			->where('t.language = ?', $_SESSION['System']['lng'])
			->where('a.id = ?', (int) $id);

		$stmt = $db->query($select);
		$result = $stmt->fetch();

		$faq = new SxModule_Faq();
		$faq = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $id,
				get_class($this) . '_' . __FUNCTION__ . '_Lng' . $lng
			));
			$cache->save($faq, $cacheId, $cacheTags);
		}

		return $faq;
	}

	public function deleteByType($type) {
		$db = Zend_Registry::get('db');
		$db->delete('Faq', 'type = ' . $type);
	}
}