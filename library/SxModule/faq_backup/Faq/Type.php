<?php

class SxModule_Faq_Type
{

	protected $_tmx;
	protected $_type_id;
	protected $_tsl_id;
	protected $_name;
	protected $_url;
	protected $_active = 1;
	protected $_language;
	protected $_faqs = array();

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		if(!isset($this->_type_id))
			return false;
		return $this->_type_id;
	}
	public function setId($typeid) {
		$this->_type_id = (int)$typeid;
		return $this;
	}

	public function getTslId() {
		return $this->_tsl_id;
	}
	public function setTslId($tsl_id) {
		$this->_tsl_id = (int)$tsl_id;
		return $this;
	}

	public function setLanguage($language) {
		$this->_language = $language;
		return $this;
	}
	public function getLanguage() {
		return $this->_language;
	}

	public function getName() {
		return $this->_name;
	}
	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getUrl() {
		return $this->_url;
	}
	public function setUrl($url) {
		$this->_url = $url;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = (int)$active;
		return $this;
	}

	public function getFaqs() {
		return $this->_faqs;
	}
	public function setFaqs($faqs) {
		$this->_faqs = $faqs;
		return $this;
	}

	public function isActive() {
		if(!$this->getActive())
			return false;
		return true;
	}

	protected function _createUrl() {
		$title = $this->getName();
		$url = strtolower($title);
		$url = str_replace('/', '-', $url);
		$url = preg_replace('%>%', '/', $url);
		$url = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $url);
		$url = preg_replace('%-{2,}%', '-', $url);
		$url = preg_replace('%/{2,}%', '/', $url);
		$url = preg_replace('%(-*)/(-*)%', '/', $url);

		$url = trim($url, '/');
		$url = trim($url, '-');

		return strtolower($url);
	}

	public function save($params = '*', $tsl_params = '*') {
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Faq_Type_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) $data = $mapper->fromInput($data, $params);

		if(is_array($tsl_params)) $tslData = $mapper->fromInput($tslData, $tsl_params);
		
		$tslData['url'] = $this->_createUrl();

		if($this->getId()) {
			$db->update('FaqType', $data, 'id = ' . (int)$this->getId());
			$db->update('FaqTypeTsl', $tslData, 'type_id = ' . $db->quote( $this->_type_id ) . ' AND language = ' . $db->quote( $this->getLanguage() ) );
		}
		else {
			$db->insert('FaqType', $data);
			$this->setId( $db->lastInsertId() );
			
			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['language'] = $lng;
				$tslData['type_id'] = (int) $this->getId();
				
				$db->insert('FaqTypeTsl', $tslData);
			}
		}
	}
	
	
	

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('FaqType', 'id = ' . $this->getId());
		$db->delete('FaqTypeTsl', 'type_id = ' . $this->getId());
	}
	
	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 0) $active = array('active' => 1);
		elseif($this->getActive() == 1) $active = array('active' => 0);

		$db->update('FaqType', $active, 'id = ' . (int)$this->getId());

		return $this;
	}

}
