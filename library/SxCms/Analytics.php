<?php

class SxCms_Analytics {

    protected $_login;
    protected $_pass;
    protected $_profileid;
	protected $_step;

	//const STEP_LOGIN = 1;
	//const STEP_PROFILE = 2;

    public function __construct() {
    	// .. bestand uitlezen..
    	$data = file_get_contents(APPLICATION_PATH.'/var/analytics.data');

    	if(trim($data) != '') {
    		try {
		    	$object = unserialize($data);

		    	if($object->getLogin() != null) {
			    	$this->setLogin($object->getLogin())
			    		->setPass($object->getPass())
			    		->setProfileid($object->getProfileid())
			    		->setStep($object->getStep());
		    	}
    		}
    		catch (Exception $e) {
    			die( $e );
    		}
   		}

    	unset($object);
    }

    public function setLogin($login) {
		$this->_login = $login;
		return $this;
    }

    public function getLogin() {
    	return $this->_login;
    }

    public function setPass($pass) {
		$this->_pass = $pass;
		return $this;
    }

    public function getPass() {
    	return $this->_pass;
    }

    public function setProfileid($profileid) {
		$this->_profileid = $profileid;
		return $this;
    }

    public function getProfileid() {
    	return $this->_profileid;
    }

    public function setStep($step) {
		$this->_step = $step;
		return $this;
    }

    public function getStep() {
    	return $this->_step;
    }
	
	public function getAll() {
		var_dump($this);
	}
	
	public function unsetAll() {
		$this->_login = null;
		$this->_pass = null;
		$this->_profileid = null;
		$this->_step = null;
		return $this;
	}

    public function save() {
    	// serialize data en opslaan in bestandje;
    	$dataToSave = serialize($this);
    	file_put_contents(APPLICATION_PATH.'/var/analytics.data', $dataToSave);
		$cache = Zend_Registry::get('cache');
		$cache->clean(
			Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG,
			array(
				'Analytics'
			)
		);
    }
}
