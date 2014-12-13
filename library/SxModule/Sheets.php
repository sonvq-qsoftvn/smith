<?php

class SxModule_Sheets
{

	protected $_id;
	protected $_dateCreated;
	protected $_dateUpdated;
	protected $_lng;
	protected $_type;
	protected $_subtype;
	protected $_typeName;
	protected $_subtypeName;
	protected $_name;
	protected $_desc;
	protected $_active;
	protected $_place;
	protected $_file;

	public function getId() {
		return (int)$this->_id;
	}
	public function setId($id) {
		$this->_id = (int)$id;
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

	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}
	public function getLng() {
		return $this->_lng;
	}

	public function getType() {
		return $this->_type;
	}
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	public function getTypeName() {
		return $this->_typeName;
	}
	public function setTypeName($typeName) {
		$this->_typeName = $typeName;
		return $this;
	}

	public function getSubtype() {
		return $this->_subtype;
	}
	public function setSubtype($subtype) {
		$this->_subtype = $subtype;
		return $this;
	}

	public function getSubTypeName() {
		return $this->_subtypeName;
	}
	public function setSubTypeName($subtypeName) {
		$this->_subtypeName = $subtypeName;
		return $this;
	}

	public function getName() {
		return $this->_name;
	}
	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getDesc() {
		return $this->_desc;
	}
	public function setDesc($desc) {
		$this->_desc = $desc;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;

		return $this;
	}

	public function getPlace() {
		return $this->_place;
	}
	public function setPlace($_place) {
		$this->_place = $_place;
		return $this;

	}

	public function getFile() {
		return $this->_file;
	}
	public function setFile($file) {
		$this->_file = $file;
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

	public function createFileName($name) {
		$names = explode('.', $name);
		$filename = str_replace('/', '-', $names[0]);
		$filename = preg_replace('%>%', '/', $filename);
		$filename = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $filename);
		$filename = preg_replace('%-{2,}%', '-', $filename);
		$filename = preg_replace('%/{2,}%', '/', $filename);
		$filename = preg_replace('%(-*)/(-*)%', '/', $filename);

		$filename = trim($filename, '-');
		$filename = trim($filename, '-');

		return strtolower($filename);
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

		$db->update('Sheets', $active, 'id = ' . (int) $this->getId());

		return true;
	}

	public function updateRank($rank) {
		$db = Zend_Registry::get('db');
		$rank++;
		$place = array('place' => $rank);
		$db->update('Sheets', $place, 'id =' . (int) $this->getId());
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Sheets_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}

		if($this->getId() == 0) {
       		$config = Zend_Registry::get('config');
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$data['date_updated'] = new Zend_Db_Expr('NOW()');
			$db->insert('Sheets', $data);
			$this->setId( $db->lastInsertId() );
			$tslData['s_id'] = $this->getId();
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$db->insert('SheetsTsl', $tslData);
			}
		}
		else {
			$data['date_updated'] = new Zend_Db_Expr('NOW()');
			$db->update('Sheets', $data, 'id = ' . (int) $this->getId());
			$tslData['s_id'] = $this->getId();
			$db->update('SheetsTsl', $tslData, 's_id = ' . (int) $this->getId() . ' AND lng = ' . $db->quote( $this->getLng() ));
		}
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('Sheets', 'id = ' . (int) $this->getId());
		$db->delete('SheetsTsl', 's_id = ' . (int) $this->getId());
	}
}