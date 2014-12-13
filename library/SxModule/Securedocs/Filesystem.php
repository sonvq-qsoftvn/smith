<?php

class SxModule_Securedocs_Filesystem extends DirectoryIterator
{
	protected $_mapping = array(
		'bmp' => 'image.png',
		'jpg' => 'image.png',
		'png' => 'image.png',
		'gif' => 'image.png',
		'csv' => 'excel.png',
		'doc' => 'word.png',
		'docx' => 'word.png',
		'pdf' => 'pdf.png',
		'txt' => 'word.png',
		'xls' => 'excel.png',
		'xlst' => 'excel.png',
		'xlsx' => 'excel.png',
		'xltx' => 'excel.png',
	);

	public function getFileType() {
		if($this->isDir()) {
			return 'folder.png';
		}

		$name = $this->getBasename();
		$type = strtolower(end(explode('.', $name)));

		if(isset($this->_mapping[$type])) {
			return $this->_mapping[$type];
		}

		return 'default.png';
	}

	public function seek($key) {
		$this->rewind();
		while($this->valid()) {
			if($this->key() === $key) {
				return $this->current();
			}
			$this->next();
		}
	}

	public function getSizeString() {
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

		$bytes = parent::getSize();
		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		$bytes /= pow(1024, $pow);

		return round($bytes, 2) . ' ' . $units[$pow];
	}

	public function isHidden() {
		if($this->getBasename() == 'mcith') {
			return true;
		}
		return false;
	}
}