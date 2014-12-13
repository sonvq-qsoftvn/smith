<?php

class SxModule_Securedocs_Dir
{
	protected $_filename;
	protected $_newFilename;

	public function __construct($filename) {
		$this->_filename = realpath($filename);
	}

	public function setFilename($filename) {
		if($filename !== basename($this->_filename)) {
			$this->_newFilename = $filename;
		}
		return $this;
	}
	public function getFilename() {
		return basename($this->_filename);
	}

	public function getBasename() {
		return basename($this->_filename);
	}

	public function isFile() {
		return false;
	}
	
	
	

	public function getPathnameFromBase() {
		$base = realpath(APPLICATION_PATH . '/../public_html/securedocs/');
		$path = str_replace($base, '', $this->_filename);
		$path = str_replace('\\', '/', $path);

		return $path;
	}

	public function getPathname() {
		return $this->_filename;
	}

	public function save() {
		$path = str_replace('\\', '/', $this->_filename);
		if($this->_newFilename) {
			$topdir = explode('/', $path);
			if(count($topdir) > 1) {
				array_pop($topdir);
				$topdir = implode('/', $topdir);
			}
			else {
				$topdir = '';
			}

			rename($this->_filename, $topdir . '/' . $this->_newFilename);
		}

		return true;
	}

	public function delete() {
		return rmdir($this->_filename);
	}

	public function getPermissions() {
		return false;
	}
}