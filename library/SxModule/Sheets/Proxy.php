<?php

class SxModule_Sheets_Proxy extends Base_Proxy
{

	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Sheets_Mapper();
	}

	public function getAll($paginator = true, $pindex = 1, $perpage = 25, $cache = true) {
		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->order('st.position ASC')
			->order('ty.position ASC')
			->order('a.place ASC');

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

	public function getAllBySubtype($type) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->where('a.subtype = ?', $type)
			->order('st.position ASC')
			->order('ty.position ASC')
			->order('a.place ASC');

		$results = $db->fetchAll($select);

		$items = array();
		foreach($results as $item) {
			$item = $this->_mapper->toObject(is_array($item) ? $item : array());
			$items[] = $item;
		}

		return $items;
	}

	public function getAllActiveByType($type) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->where('a.active = 1')
			->where('a.type = ?', $type)
			->order('st.position ASC')
			->order('ty.position ASC')
			->order('a.place ASC');

		$results = $db->fetchAll($select);

		$items = array();
		foreach($results as $item) {
			$item = $this->_mapper->toObject(is_array($item) ? $item : array());
			$items[] = $item;
		}

		return $items;
	}

	public function getAllActive() {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->where('a.active = 1')
			->order('st.position ASC')
			->order('a.place ASC');

		$results = $db->fetchAll($select);

		$items = array();
		foreach($results as $item) {
			$item = $this->_mapper->toObject(is_array($item) ? $item : array());
			$items[] = $item;
		}

		return $items;
	}

	public function getById($id, $cache = true) {

		if($cache == true) {
			$cacheId = $this->generateCacheId(get_class($this) . '_' . __FUNCTION__, func_get_args());
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache->load($cacheId))) {
				return $result;
			}
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->where('a.id = ?', (int) $id);

		$stmt = $db->query($select);
		$result = $stmt->fetch();
		$item = $this->_mapper->toObject(is_array($result) ? $result : array());

		if($cache == true) {
			$cacheTags = $this->generateCacheTags(get_class($this) . '_' . __FUNCTION__, array(
				get_class($this) . '_' . __FUNCTION__ . '_Id' . (int) $id
			));

			$cache->save($item, $cacheId, $cacheTags);
		}

		return $item;
	}

	public function deleteByType($type) {
		$db = Zend_Registry::get('db');
		$db->delete('Sheets', 'subtype = ' . $type);
	}

	public function search($search, $lng = 'nl') {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Sheets'), array('*'))
			->join(array('t' => 'SheetsTsl'), 'a.id = t.s_id', array( 'lng', 'name', 't_desc', 't_file' ))
			->join(array('ty' => 'SheetsSubtype'), 'a.subtype = ty.subtype_id', array())
			->join(array('tyt' => 'SheetsSubtypeTsl'), 'ty.subtype_id = tyt.subtype_id', array('name as subtypename'))
			->join(array('st' => 'SheetsType'), 'a.type = st.type_id', array())
			->join(array('stt' => 'SheetsTypeTsl'), 'st.type_id = stt.type_id', array('name as typename'))
			->where('t.lng = ?', $_SESSION['System']['lng'])
			->where('tyt.lng = ?', $_SESSION['System']['lng'])
			->where('stt.lng = ?', $_SESSION['System']['lng'])
			->where('t.name LIKE '.$db->quote('%$search%').' OR t.t_desc LIKE '.$db->quote('%$search%').' OR tyt.name LIKE '.$db->quote('%$search%').' OR stt.name LIKE '.$db->quote('%$search%'))
			->where('a.active = 1')
			->order('st.position ASC')
			->order('a.place ASC');

		$results = $db->fetchAll($select);

		$items = array();
		foreach($results as $item) {
			$item = $this->_mapper->toObject(is_array($item) ? $item : array());
			$items[] = $item;
		}

		return $items;
	}
}