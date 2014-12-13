<?php

class SxModule_Contentblock
{
	protected $_tmx;

	protected $_id;
	protected $_tsl_id;
	protected $_blockname;
	protected $_active = 1;
	protected $_title;
	protected $_content;
	protected $_lng;

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

	public function getTslId() {
		return $this->_tsl_id;
	}
	public function setTslId($tsl_id) {
		$this->_tsl_id = (int)$tsl_id;
		return $this;
	}

	public function getBlockname() {
		return $this->_blockname;
	}
	public function setBlockname($blockname) {
		$this->_blockname = $blockname;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($_active) {
		$this->_active = $_active;
		return $this;
	}

	public function getTitle() {
		return $this->_title;
	}
	public function setTitle($title) {
		$this->_title = $title;
		return $this;
	}

	public function getContent() {
		return $this->_content;
	}
	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}

	public function getLng() {
		return $this->_lng;
	}
	public function setLng($lng) {
		$this->_lng = $lng;
		return $this;
	}




	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 0) {
			$active = array('active' => 1);
		}
		elseif($this->getActive() == 1) {
			$active = array('active' => 0);
		}

		$db->update('ContentBlocks', $active, 'id = ' . (int)$this->getId());

		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('ContentBlocks', 'id = ' . (int)$this->getId());
		$db->delete('ContentBlocksTsl', 'b_id = ' . (int)$this->getId());

		return $this;
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Contentblock_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}

		if($this->getId()) {
			$db->update('ContentBlocks', $data, 'id = ' . (int)$this->getId());
			$db->update('ContentBlocksTsl', $tslData, 'b_id = ' . (int)$this->getId() . ' AND lng = ' . $db->quote($this->getLng()));
		}
		else {
			$db->insert('ContentBlocks', $data);
			$this->setId($db->lastInsertId());

			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['b_id'] = (int)$this->getId();
				$db->insert('ContentBlocksTsl', $tslData);
			}
		}

		return $this;
	}
}