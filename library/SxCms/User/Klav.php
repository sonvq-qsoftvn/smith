<?php
class SxCms_User_Klav extends SxCms_User {
	protected $_doccheck;
	protected $_farmanager = array();
	protected $_clientId;
	protected $_language = "nl";
	protected $_groups = array();
	protected $_docmanager = array();
	protected $_clients = array();
	protected $_named;
	protected $_sessionId;
	protected $_username;
	
	/**
	 * @return the $_doccheck
	 */
	public function getDoccheck() {
		return $this->_doccheck;
	}

	/**
	 * @param $_doccheck the $_doccheck to set
	 */
	public function setDoccheck($_doccheck) {
		$this->_doccheck = $_doccheck;
	}

	/**
	 * @return the $_farmanager
	 */
	public function getFarmanager() {
		return $this->_farmanager;
	}

	/**
	 * @param $_farmanager the $_farmanager to set
	 */
	public function setFarmanager($_farmanager) {
		$this->_farmanager = $_farmanager;
	}

	/**
	 * @return the $_clientId
	 */
	public function getClientId() {
		return $this->_clientId;
	}

	/**
	 * @param $_clientId the $_clientId to set
	 */
	public function setClientId($_clientId) {
		$this->_clientId = $_clientId;
	}

	/**
	 * @return the $_language
	 */
	public function getLanguage() {
		return $this->_language;
	}

	/**
	 * @param $_language the $_language to set
	 */
	public function setLanguage($_language) {
		$this->_language = $_language;
	}

	/**
	 * @return the $_groups
	 */
	public function getGroups() {
		return $this->_groups;
	}

	/**
	 * @param $_groups the $_groups to set
	 */
	public function setGroups($_groups) {
		$this->_groups = $_groups;
	}

	/**
	 * @return the $_docmanager
	 */
	public function getDocmanager() {
		return $this->_docmanager;
	}

	/**
	 * @param $_docmanager the $_docmanager to set
	 */
	public function setDocmanager($_docmanager) {
		$this->_docmanager = $_docmanager;
	}

	/**
	 * @return the $_clients
	 */
	public function getClients() {
		return $this->_clients;
	}

	/**
	 * @param $_clients the $_clients to set
	 */
	public function setClients($_clients) {
		$this->_clients = $_clients;
	}

	/**
	 * @return the $_named
	 */
	public function getNamed() {
		return $this->_named;
	}

	/**
	 * @param $_named the $_named to set
	 */
	public function setNamed($_named) {
		$this->_named = $_named;
	}

	/**
	 * @return the $_sessionId
	 */
	public function getSessionId() {
		return $this->_sessionId;
	}

	/**
	 * @param $_sessionId the $_sessionId to set
	 */
	public function setSessionId($_sessionId) {
		$this->_sessionId = $_sessionId;
	}

	/**
	 * @return the $_username
	 */
	public function getUsername() {
		return $this->_username;
	}

	/**
	 * @param $_username the $_username to set
	 */
	public function setUsername($_username) {
		$this->_username = $_username;
	}
}