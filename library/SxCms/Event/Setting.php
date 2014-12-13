<?php

class SxCms_Event_Setting
{
	protected $_variable;
	protected $_value;
	protected $_language;

	public function setVariable($variable) {
		$this->_variable = $variable;
		return $this;
	}
	public function getVariable() {
		return $this->_variable;
	}

	public function setValue($value) {
		$this->_value = $value;
		return $this;
	}
	public function getValue() {
		return $this->_value;
	}

	public function setLanguage($language) {
		$this->_language = $language;
		return $this;
	}
	public function getLanguage() {
		return $this->_language;
	}

	public function save() {
		$db = Zend_Registry::get('db');
		$settingData = array(
			'variable' => $this->getVariable(),
			'value' => $this->getValue(),
			'language' => $this->getLanguage()
		);

		$db->update('EventSettings', $settingData, 'variable = "' . $this->getVariable() . '"
            AND language = "' . $this->getLanguage() . '"');
	}
}