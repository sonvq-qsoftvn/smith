<?php

class SxModule_Securedocs_Folder
{
	protected $_folderId;
	protected $_foldername;

	public function getFolderId() {
		return $this->_folderId;
	}
	public function setFolderId($folderId) {
		$this->_folderId = $folderId;
	}

	public function getFoldername() {
		return $this->_foldername;
	}
	public function setFoldername($foldername) {
		$this->_foldername = $foldername;
	}




	public function save() {
		$db = Zend_Registry::get('db');

		$data = array('foldername' => $this->getFoldername());

		if(!$this->getFolderId()) {
			$db->insert('SecureDocsFolder', $data);
			$id = $db->lastInsertId();
		}
		else {
			$id = $this->getFolderId();
			$db->update('SecureDocsFolder', $data, 'folder_id = ' . $id);
		}
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('SecureDocsFolder', 'folder_id = ' . $this->getFolderId());
	}
}