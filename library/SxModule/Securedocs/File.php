<?php

class SxModule_Securedocs_File extends SplFileObject
{

	protected $_filename;
	protected $_path;
	protected $_mail;
	protected $_summary;

	public function __construct($filename) {
		$this->_filename = realpath($filename);
		parent::__construct($filename);
	}

	public function setFilename($filename) {
		$this->_filename = $filename;
		return $this;
	}

	public function setPath($path) {
		$this->_path = $path;
		return $this;
	}
	public function getPath() {
		return $this->_path;
	}

	public function setMail($mail) {
		$this->_mail = $mail;
		return $this;
	}
	public function getMail() {
		return $this->_mail;
	}

	public function setSummary($summary) {
		$this->_summary = $summary;
		return $this;
	}
	public function getSummary() {
		return $this->_summary;
	}




	public function getFile() {
		$info = $this->openFile('r+');
		$b = '';
		while(!$info->eof()) {
			$b .= $info->fgets();
		}
		return $b;
	}

	public function save() {
		$encoded = base64_encode($this->_path . '/' . $this->getFilename());
		$db = Zend_Registry::get('db');
		$data = array( 'filename' => $encoded, 'mail' => $this->_mail, 'summary' => $this->_summary );

		$db->delete('SecureFilemanager', 'filename LIKE "' . $encoded . '"');
		return $db->insert('SecureFilemanager', $data);
	}

	public function delete() {
		$encoded = base64_encode($this->_path . '/' . $this->getFilename());
		$db = Zend_Registry::get('db');
		return $db->delete('SecureFilemanager', 'filename LIKE "' . $encoded . '"');
	}
}