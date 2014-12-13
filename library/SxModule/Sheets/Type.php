<?php

class SxModule_Sheets_Type
{

	protected $_id;
	protected $_name;
	protected $_scheme;
	protected $_active;
	protected $_lng;
	protected $_subtypes = array();
	protected $_position;

	public function getId() {
		if(!isset($this->_id))
			return false;
		return $this->_id;
	}
	public function setId($id) {
		$this->_id = (int)$id;
		return $this;
	}

	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}
	public function getLng() {
		return $this->_lng;
	}

	public function getName() {
		return $this->_name;
	}
	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getScheme() {
		return $this->_scheme;
	}
	public function setScheme($scheme) {
		$this->_scheme = $scheme;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = (int)$active;
		return $this;
	}

	public function getSubtypes() {
		return $this->_subtypes;
	}
	public function setSubtypes($subtypes) {
		$this->_subtypes = $subtypes;
		return $this;
	}
	public function addSubtype($subtype) {
		$this->_subtypes[] = $subtype;
		return $this;
	}

	public function getPosition() {
		return $this->_position;
	}
	public function setPosition($_position) {
		$this->_position = $_position;
		return $this;
	}

	public function getUrl() {
		$url = strtolower($this->getName());
		$url = preg_replace('%>%', '/', $url);
		$url = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $url);
		$url = preg_replace('%-{2,}%', '-', $url);
		$url = preg_replace('%/{2,}%', '/', $url);
		$url = preg_replace('%(-*)/(-*)%', '/', $url);

		$url = trim($url, '/');
		$url = trim($url, '-');

		return strtolower($url);
	}

	public function activate() {
		$db = Zend_Registry::get('db');
		if($this->_active) $active = array('active' => 0);
		else $active = array('active' => 1);

		$db->update('SheetsType', $active, 'type_id = ' . $this->_id);

		return true;
	}

	public function updateRank($rank) {
		$db = Zend_Registry::get('db');
		$rank++;
		$place = array('position' => $rank);
		$db->update('SheetsType', $place, 'type_id =' . $this->getId());
	}

	public function save() {
		$db = Zend_Registry::get('db');
		$config = Zend_Registry::get('config');

		$mapper = new SxModule_Sheets_Type_Mapper();
		$typeData = $mapper->toArray($this, 'item');
		$typeTsl = $mapper->toArray($this, 'tsl');

		if($this->getId() == 0) {
			$db->insert('SheetsType', $typeData);
			$type_id = $db->lastInsertId();
			
			foreach($config->system->language as $lng => $slng) {
				$typeTsl['lng'] = $lng;
				$typeTsl['type_id'] = $type_id;
				$db->insert('SheetsTypeTsl', $typeTsl);
			}
		}
		else {
			$type_id = $this->getId();
			
			$db->update('SheetsType', $typeData, 'type_id = ' . $type_id);
			$db->update('SheetsTypeTsl', $typeTsl, 'type_id = ' . $type_id . ' AND lng = \'' . $this->getLng() . '\'');
		}

		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('SheetsType', 'type_id = ' . $this->getId());
		$db->delete('SheetsTypeTsl', 'type_id = ' . $this->getId());
	}
}