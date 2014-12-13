<?php

class SxModule_Members_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Members_Mapper();
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
			->from(array('a' => 'Member'), array('*'))
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

	public function getAllByGroups($ids) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Member'), array('*'))
			->join(array('t' => 'MemberGroups'), 'a.id = t.member_id', array('group_id'))
			->where("t.group_id IN (?)", $ids)
			->order('a.id ASC')
			->group('a.id');

		$results = $this->_mapper->mapAll($db->fetchAll($select));

		return $results;
	}

	public function getById($id, $lng = 'nl') {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Member'), array('*'))
			->where('a.id = ?', (int) $id);

		$result = $db->fetchRow($select);
		$result = $this->_mapper->toObject($result);

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'MemberGroups'), array('*'))
			->where('a.member_id = ?', (int) $result->getId())
			->order('a.group_id ASC');

		$results = $db->fetchAll($select);
		$groups = array();
		foreach($results as $resultaat) {
			$groups[] = $resultaat['group_id'];
		}

		$result->setGroups($groups);

		return $result;
	}

	public function getByLogin($login, $password) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Member'), array('*'))
			->where('a.email = ?', $login)
			->where('a.password = ?', $password);

		$result = $this->_mapper->toObject($db->fetchRow($select));

		return $result;
	}

	public function getByEmail($email) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'Member'), array('*'))
			->where('a.email = ?', $email);

		$stmt = $db->query($select);
		$result = $stmt->fetch();

		return ( $result ? $this->_mapper->toObject($result) : new SxModule_Members() );
	}

	public function checkLogin($login) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Member', array('*'))
			->where('email = ?', $login)
			->where("active = ?", 1);

		return ($db->fetchRow($select) ? true : false);
	}

	public function checkPassword($password, $login) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Member', array('*'))
			->where('password = ?', $password)
			->where('email = ?', $login);

		return ($db->fetchRow($select) ? true : false);
	}
}