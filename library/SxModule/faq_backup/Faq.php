<?php

class SxModule_Faq
{
	protected $_tmx;
	protected $_id;
	protected $_tsl_id;
	protected $_type;
	protected $_typeName;
	protected $_language;
	protected $_question;
	protected $_answer;
	protected $_active;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return (int)$this->_id;
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

	public function setLanguage($language) {
		$this->_language = $language;
		return $this;
	}
	public function getLanguage() {
		return $this->_language;
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

	public function getQuestion() {
		return $this->_question;
	}
	public function setQuestion($question) {
		$this->_question = $question;
		return $this;
	}

	public function getAnswer() {
		return $this->_answer;
	}
	public function setAnswer($answer) {
		$this->_answer = $answer;
		return $this;
	}

	public function getActive() {
		return $this->_active;
	}
	public function setActive($active) {
		$this->_active = $active;
		return $this;
	}




	public function getUrl() {
		$url = strtolower($this->getQuestion());
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
		$mapper = new SxModule_Faq_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}

		if($this->getId()) {
			$db->update('Faq', $data, 'id = ' . (int) $this->getId());
			$db->update('FaqTsl', $tslData, 'faq_id = ' . (int) $this->getId() . ' AND language = ' . $db->quote($this->getLanguage()));
		}
		else {
			$db->insert('Faq', $data);
			$this->setId( $db->lastInsertId() );
			
			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['language'] = $lng;
				$tslData['faq_id'] = (int) $this->getId();

				$db->insert('FaqTsl', $tslData);
			}
		}
	}
	
	
	

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('Faq', 'id = ' . (int) $this->getId());
		$db->delete('FaqTsl', 'faq_id = ' . (int) $this->getId());
	}
	
	public function activate() {
		$db = Zend_Registry::get('db');

		if($this->getActive() == 0) {
			$active = array('active' => 1);
		}
		elseif($this->getActive() == 1) {
			$active = array('active' => 0);
		}

		$db->update('Faq', $active, 'id = ' . (int)$this->getId());

		return $this;
	}
}