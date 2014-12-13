<?php

class SxModule_Webtv
{
	protected $_tmx;

	protected $_id;
	protected $_authorId;
	protected $_dateCreated;
	protected $_dateUpdated;
	protected $_datePublished;
	protected $_youtube;
	protected $_lng;
	protected $_url;
	protected $_title;
	protected $_description;
	protected $_active;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return $this->_id;
	}
	public function setId($id) {
		$this->_id = (int)$id;
		return $this;
	}

	public function getAuthorId() {
		return $this->_authorId;
	}
	public function setAuthorId($authorId) {
		$this->_authorId = $authorId;
		return $this;
	}

	public function getDateCreated() {
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

	public function getDatePublished() {
		return $this->_datePublished;
	}
	public function setDatePublished($datePublished) {
		$this->_datePublished = $datePublished;
		return $this;
	}

	public function getYoutube() {
		return $this->_youtube;
	}
	public function setYoutube($youtube) {
		$this->_youtube = $youtube;
		return $this;
	}

	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}
	public function getLng() {
		return $this->_lng;
	}

	public function getUrl() {
		return $this->_url;
	}
	public function setUrl($url) {
		$this->_url = $url;
		return $this;
	}

	public function getTitle() {
		return $this->_title;
	}
	public function setTitle($title) {
		$this->_title = $title;
		return $this;
	}

	public function getDescription() {
		return $this->_description;
	}
	public function setDescription($description) {
		$this->_description = $description;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;
		return $this;
	}
	public function isActive() {
		return ($this->getActive() == 1) ? true : false;
	}




	protected function _createUrl() {
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




	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Webtv_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}
		
		if($this->getId()) {
			$lng = $_SESSION['System']['lng'];
			$tslData['lng'] = $lng;
			$proxy = new SxModule_Webtv_Proxy();
			$data['date_updated'] = new Zend_Db_Expr('NOW()');
			
			$db->update('WebTv', $data, 'id = ' . (int) $this->getId());
			$db->update('WebTvTsl', $tslData, 'webtv_id = ' . (int) $this->getId() . ' AND lng = ' . $db->quote( $lng ));
		}
		else {
			$data['date_updated'] = '0000-00-00 00:00:00';
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			
			$db->insert('WebTv', $data);
			$webtvid = (int)$db->lastInsertId();

			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['webtv_id'] = $webtvid;
				if($lng != $_SESSION['System']['lng']) {
					$tslDatasl['active'] = 0;
				}
				$db->insert('WebTvTsl', $tslData);
			}
		}
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('WebTv', 'id = ' . (int) $this->getId());
		$db->delete('WebTvTsl', 'webtv_id = ' . (int) $this->getId());
	}

	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 1) {
			$data = array('active' => 0);
			$this->setActive( 0 );
		}
		else {
			$data = array('active' => 1);
			$this->setActive( 1 );
		}

		$db->update('WebTvTsl', $data, 'webtv_id = ' . (int) $this->getId() . ' AND lng = ' . $db->quote( $this->getLng() ));

		return true;
	}
}