<?php

class SxModule_Members_Email_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Members_Email_Mapper();
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
			->from(array('a' => 'MemberMail'), array('*'))
			->join(array('t' => 'MemberMailTsl'), 'a.id = t.mail_id', array('lng','subject','content'))
			->where('t.lng = ?', $lng)
			->order('a.id ASC');

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

	public function getById($id) {
		$lng = $_SESSION['System']['lng'];
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'MemberMail'), array('*'))
			->join(array('t' => 'MemberMailTsl'), 'a.id = t.mail_id', array('lng', 'subject', 'content'))
			->where('t.lng = ?', $lng)
			->where('a.id = ?', (int) $id);

		$result = $this->_mapper->toObject($db->fetchRow($select));

		return $result;
	}
}