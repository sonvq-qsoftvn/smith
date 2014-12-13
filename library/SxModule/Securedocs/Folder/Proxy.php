<?php

class SxModule_Securedocs_Folder_Proxy
{
	public function getByFolder($folder) {
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('SecureDocsFolder')
			->where('foldername = ?', $folder);

		$stm = $db->query($select);
		$result = $stm->fetch();
		$item = $this->_map($result);

		return $item;
	}

	public function getAll() {
		$db = Zend_Registry::get('db');
		$select = $db->select()->from('SecureDocsFolder')->order('foldername ASC');

		$stm = $db->query($select);
		$results = $stm->fetchAll();

		$items = array();
		foreach($results as $item) {
			$items[] = $this->_map($item);
		}

		return $items;
	}

	private function _map($item) {
		$obj = new SxModule_Securedocs_Folder();
		$obj->setFolderId($item['folder_id']);
		$obj->setFoldername($item['foldername']);

		return $obj;
	}
}