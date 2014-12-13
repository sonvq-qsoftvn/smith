<?php

class SxModule_Sheets_Subtype
{

	protected $_id;
	protected $_name;
	protected $_type;
	protected $_active;
	protected $_lng;
	protected $_sheets = array();
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
		return $this;
	}
	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = (int)$active;
		return $this;
	}

	public function getType() {
		return $this->_type;
	}
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	public function getSheets() {
		return $this->_sheets;
	}
	public function setSheets($sheets) {
		$this->_sheets = $sheets;
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

	public function isActive() {
		if(!$this->getActive()) return false;
		else return true;
	}

	public function activate() {
		$db = Zend_Registry::get('db');
		if($this->_active) $active = array('active' => 0);
		else $active = array('active' => 1);

		$db->update('SheetsSubtype', $active, 'subtype_id = ' . $this->_id);

		return true;
	}

	public function updateRank($rank) {
		$db = Zend_Registry::get('db');
		$rank++;
		$place = array('position' => $rank);
		$db->update('SheetsSubtype', $place, 'subtype_id =' . $this->getId());
	}

	public function save($type) {
		$db = Zend_Registry::get('db');
		$config = Zend_Registry::get('config');

		$mapper = new SxModule_Sheets_Subtype_Mapper();
		$typeData = $mapper->toArray($this, 'item');
		$typeTsl = $mapper->toArray($this, 'tsl');

		$typeData['type'] = $type;

		if($this->getId() == 0) {
			$db->insert('SheetsSubtype', $typeData);
			$type_id = $db->lastInsertId();
			
			$typeTsl = array( 'subtype_id' => $type_id, 'name' => $this->getName(), );
			
			foreach($config->system->language as $lng => $slng) {
				$typeTsl['subtype_id'] = $type_id;
				$typeTsl['lng'] = $lng;
				$db->insert('SheetsSubtypeTsl', $typeTsl);
			}
		}
		else {
			$type_id = $this->getId();
			$db->update('SheetsSubtype', $typeData, 'subtype_id = ' . $type_id);
			
			$typeTsl = array( 'subtype_id' => $type_id, 'name' => $this->getName(), );
			$db->update('SheetsSubtypeTsl', $typeTsl, 'subtype_id = ' . $typeTsl['subtype_id'] . ' AND lng = \'' . $this->getLng() . '\'');
		}

		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('SheetsSubtype', 'subtype_id = ' . $this->getId());
		$db->delete('SheetsSubtypeTsl', 'subtype_id = ' . $this->getId());
	}
}