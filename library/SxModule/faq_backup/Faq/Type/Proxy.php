<?php

class SxModule_Faq_Type_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Faq_Type_Mapper();
	}

	public function getAll($lng, $paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			
			if(true == ($result = $cache->load($cacheId))) return $result;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'FaqType'), array('*'))
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('*'))
			->where('language = ?', $lng);
			
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

	public function getAllActive() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'FaqType'), array('*'))
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('*'))
			->where('language = ?', $db->quote( $_SESSION['System']['lng']) )
			->where('active = 1');

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$types = array();
		foreach($results as $result) {
			$type = new SxModule_Faq_Type();
			$type = $this->_mapper->toObject(is_array($result) ? $result : array());
			$proxy = new SxModule_Faq_Proxy();
			$faqs = $proxy->getAllByType($result['id']);
			$type->setFaqs($faqs);

			$types[] = $type;
		}

		return $types;
	}

	public function getTypeById($id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('ty' => 'FaqType'), array('*'))
			->join(array('tyt' => 'FaqTypeTsl'), 'ty.id = tyt.type_id', array('*'))
			->where('language = ?', $_SESSION['System']['lng'] )
			->where('ty.id = ?', (int) $id);

		$stmt = $db->query($select);
		$result = $stmt->fetch();

		$type = new SxModule_Faq_Type();
		$type = $this->_mapper->toObject(is_array($result) ? $result : array());

		return $type;
	}
}