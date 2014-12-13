<?php

class SxModule_News
{

	protected $_tmx;

	protected $_nid;
	protected $_lng;
	protected $_active;
	protected $_authorId;
	protected $_dateCreated;
	protected $_dateUpdated;
	protected $_datePublished;
	protected $_dateExpired;
	protected $_title;
	protected $_summary;
	protected $_content;
	protected $_url;
	protected $_seoKeywords;
	protected $_seoTitle;
	protected $_seoDescription;
	protected $_picture;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return $this->_nid;
	}
	public function setId($nid) {
		$this->_nid = $nid;
		return $this;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;
		return $this;
	}

	public function getAuthorId() {
		return $this->_authorId;
	}
	public function setAuthorId($authorId) {
		$this->_authorId = $authorId;
		return $this;
	}

	public function getDateCreated($format = null) {
		if($format) {
			return strftime($format, strtotime($this->_dateCreated));
		}
		return $this->_dateCreated;
	}
	public function setDateCreated($dateCreated) {
		$this->_dateCreated = $dateCreated;
		return $this;
	}

	public function getDateUpdated() {
		return $this->_dateUpdated;
	}
	public function setDateUpdated($dateUpdated) {
		$this->_dateUpdated = $dateUpdated;
		return $this;
	}

	public function getDatePublished($format = null) {
		if($format) {
			return strftime($format, strtotime($this->_datePublished));
		}
		return $this->_datePublished;
	}
	public function setDatePublished($datePublished) {
		$this->_datePublished = $datePublished;
		return $this;
	}

	public function getDateExpired($format = null) {
		if($format) {
			return strftime($format, strtotime($this->_dateExpired));
		}
		return $this->_dateExpired;
	}
	public function setDateExpired($dateExpired) {
		$this->_dateExpired = $dateExpired;
		return $this;
	}

	public function getTitle() {
		return $this->_title;
	}
	public function setTitle($title) {
		$this->_title = $title;
		return $this;
	}

	public function getSummary() {
		return $this->_summary;
	}
	public function setSummary($summary) {
		$this->_summary = $summary;
		return $this;
	}

	public function getContent() {
		return $this->_content;
	}
	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}

	public function getUrl() {
		return $this->_url;
	}
	public function setUrl($url) {
		$this->_url = $url;
		return $this;
	}

	public function getSeoKeywords() {
		return $this->_seoKeywords;
	}
	public function setSeoKeywords($seoKeywords) {
		$this->_seoKeywords = $seoKeywords;
		return $this;
	}

	public function getSeoTitle() {
		return $this->_seoTitle;
	}
	public function setSeoTitle($seoTitle) {
		$this->_seoTitle = $seoTitle;
		return $this;
	}

	public function getSeoDescription() {
		return $this->_seoDescription;
	}
	public function setSeoDescription($seoDescription) {
		$this->_seoDescription = $seoDescription;
		return $this;
	}

	public function getPicture() {
		return $this->_picture;
	}
	public function setPicture($_picture) {
		$this->_picture = $_picture;
	}




	public function _createUrl() {
		$title = $this->getTitle();
		$url = strtolower($title);
		$url = preg_replace('%>%', '/', $url);
		$url = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $url);
		$url = preg_replace('%-{2,}%', '-', $url);
		$url = preg_replace('%/{2,}%', '/', $url);
		$url = preg_replace('%(-*)/(-*)%', '/', $url);

		$url = trim($url, '-');
		$url = trim($url, '-');

		return strtolower($url);
	}

	public function createThumbName($name) {
		$names = explode('.', $name);
		$thumbname = str_replace('/', '-', $names[0]);
		$thumbname = preg_replace('%>%', '/', $thumbname);
		$thumbname = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $thumbname);
		$thumbname = preg_replace('%-{2,}%', '-', $thumbname);
		$thumbname = preg_replace('%/{2,}%', '/', $thumbname);
		$thumbname = preg_replace('%(-*)/(-*)%', '/', $thumbname);

		$thumbname = trim($thumbname, '-');
		$thumbname = trim($thumbname, '-');

		return strtolower($thumbname);
	}




	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_News_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}
		
		if($this->getId()) {
			$data['date_updated'] = new Zend_Db_Expr('NOW()');
			
			$db->update('News', $data, 'nid = ' . $db->quote( (int) $this->getId() ));
			$db->update('NewsTsl', $tslData, 'nid = ' . $db->quote( (int) $this->getId() ) . ' AND lng = ' . $db->quote( $this->getLng() ));
		}
		else {
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$data['date_updated'] = '0000-00-00 00:00:00';
			
			$db->insert('News', $data);
			$this->setId($db->lastInsertId());

			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['nid'] = (int) $this->getId();
				$db->insert('NewsTsl', $tslData);
			}
		}

		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('News', 'nid = ' . $db->quote( (int) $this->getId()));
		$db->delete('NewsTsl', 'nid = ' . $db->quote( (int) $this->getId()));

		return true;
	}

	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 1) {
			$active = array('active' => 0);
			$this->setActive(0);
		}
		else {
			$active = array('active' => 1);
			$this->setActive(1);
		}

		$cache = Zend_Registry::get('cache');
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
			'SxModule_News'
		));

		$db->update('NewsTsl', $active, 'nid = ' . $db->quote( (int) $this->getId()));

		return true;
	}
}