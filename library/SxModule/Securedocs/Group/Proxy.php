<?php

class SxModule_Securedocs_Group_Proxy
{
	public function getById($id) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('SecureDocsGroup')
			->where('group_id = ?', (int) $id);

		$stm = $db->query($select);
		$result = $stm->fetch();
		$item = $this->_map($result);

		return $item;
	}

	public function getAll() {
		$db = Zend_Registry::get('db');

		$select = $db->select()
			->from(array('a' => 'SecureDocsGroup'), array('*'))
			->order('a.group');

		$stm = $db->query($select);
		$results = $stm->fetchAll();

		$items = array();
		foreach($results as $item) {
			$items[] = $this->_map($item);
		}

		return $items;
	}

	public function getAllByMap($id) {
		$db = Zend_Registry::get('db');

		$select = $db->select()
			->from(array('a' => 'SecureDocsGroup'), array('*'))
			->join(array('t' => 'SecureDocsGroupMaps'), 'a.group_id = t.group_id', array('mapname'))
			->order('a.group')
			->where('t.mapname = ?', (int) $id);

		$results = $db->fetchAll($select);

		$items = $this->_mapall($results);

		return $items;
	}

	public function getAllMapsByGroupIds($ids) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('a' => 'SecureDocsGroupMaps'), array('*'))
			->join(array('t' => 'SecureDocsFolder'), 'a.mapname = t.folder_id', array('foldername'))
			->where("a.group_id IN  ?", $ids)
			->order('t.foldername ASC')
			->group('t.foldername');

		$results = $db->fetchAll($select);

		return $results;
	}

	private function _map($item) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('t' => 'SecureDocsGroupMaps'), array('*'))
			->where('t.group_id = ?', (int) $item['group_id']);

		$results = $db->fetchAll($select);
		$maps = array();
		foreach($results as $result) {
			$maps[] = $result['mapname'];
		}

		$obj = new SxModule_Securedocs_Group();
		$obj->setGroupId((int) $item['group_id']);
		$obj->setGroup($item['group']);
		$obj->setMaps($maps);

		return $obj;
	}
}