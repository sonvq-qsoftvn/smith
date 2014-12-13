<?php

class SxModule_Eyecatchers
{
	protected $_tmx;
	protected $_id;
	protected $_tsl_id;
	protected $_dateCreated;
	protected $_dateUpdated;
	protected $_picture;
	protected $_active;
	protected $_place;
	protected $_lng;
	protected $_title;
	protected $_subtitle;
	protected $_url;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return $this->_id;
	}
	public function setId($_id) {
		$this->_id = $_id;
		return $this;
	}

	public function getTslId() {
		return $this->_tsl_id;
	}
	public function setTslId($tsl_id) {
		$this->_tsl_id = (int)$tsl_id;
		return $this;
	}

	public function getDateCreated() {
		return $this->_dateCreated;
	}
	public function setDateCreated($_dateCreated) {
		$this->_dateCreated = $_dateCreated;
		return $this;
	}

	public function getDateUpdated() {
		return $this->_dateUpdated;
	}
	public function setDateUpdated($_dateUpdated) {
		$this->_dateUpdated = $_dateUpdated;
		return $this;
	}

	public function getPicture() {
		return $this->_picture;
	}
	public function setPicture($_picture) {
		$this->_picture = $_picture;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($_active) {
		$this->_active = $_active;
		return $this;
	}

	public function getPlace() {
		return $this->_place;
	}
	public function setPlace($_place) {
		$this->_place = $_place;
		return $this;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($_lng) {
		$this->_lng = $_lng;
		return $this;
	}

	public function getTitle() {
		return $this->_title;
	}
	public function setTitle($_title) {
		$this->_title = $_title;
		return $this;
	}

	public function getSubtitle() {
		return $this->_subtitle;
	}
	public function setSubtitle($_subtitle) {
		$this->_subtitle = $_subtitle;
		return $this;
	}

	public function getUrl() {
		return $this->_url;
	}
	public function setUrl($_url) {
		$this->_url = $_url;
		return $this;
	}




	public function createThumbName($name) {
		$names = explode('.', $name);
		$thumbname = str_replace('/', '-', $names[0]);
		$thumbname = preg_replace('%>%', '/', $thumbname);
		$thumbname = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $thumbname);
		$thumbname = preg_replace('%-{2,}%', '-', $thumbname);
		$thumbname = preg_replace('%/{2,}%', '-', $thumbname);
		$thumbname = preg_replace('%(-*)/(-*)%', '-', $thumbname);

		$thumbname = trim($thumbname, '-');
		$thumbname = trim($thumbname, '-');

		return strtolower($thumbname);
	}




	public function updateRank($rank) {
		$db = Zend_Registry::get('db');
		$rank++;
		$place = array('place' => $rank);
		$db->update('Eyecatchers', $place, 'id =' . (int) $this->getId());
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('Eyecatchers', 'id = ' . (int) $this->getId());
		$db->delete('EyecatchersTsl', 'e_id = ' . (int) $this->getId());

		return true;
	}

	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive()) {
			$active = array('active' => 0);
		}
		else {
			$active = array('active' => 1);
		}

		$db->update('Eyecatchers', $active, 'id = ' . (int) $this->getId());

		return true;
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Eyecatchers_Mapper();
		
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

			$db->update('Eyecatchers', $data, 'id = ' . (int) $this->getId());
			$db->update('EyecatchersTsl', $tslData, 'e_id = ' . (int) $this->getId() . ' AND lng = ' . $db->quote($this->getLng()));
		}
		else {
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$data['date_updated'] = '0000-00-00 00:00:00';

			$db->insert('Eyecatchers', $data);
			$this->setId( $db->lastInsertId() );
			
			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['e_id'] = (int)$this->getId();
				$db->insert('EyecatchersTsl', $tslData);
			}
		}

		return $this;
	}
}