<?php

class SxModule_Subscribe_Proxy extends Base_Proxy
{
	protected $_mapper;

	public function __construct() {
		$this->_mapper = new SxModule_Subscribe_Mapper();
	}
	
    public function getById($id) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Subscribe'), array('a.*'))
                ->where('a.id = ?', (int) $id);

        $result = $db->fetchRow($select);
		$item = $this->_mapper->toObject(is_array($result) ? $result : array());

        return $item;
    }
    
    public function getByEmail($email) {

        return $subscriber;
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Subscribe'), array('a.*'))
                ->where('a.email = ?', $email);

        $result = $db->fetchRow($select);
		$item = $this->_mapper->toObject(is_array($result) ? $result : array());

        return $item;
    }

    public function getAllActive() {

		$db = Zend_Registry::get('db');
		$select = $db->select()
                ->from(array('a' => 'Subscribe'), array('a.*'))
                ->where('a.active = ?', '1');
				
		$results = $db->fetchAll($select);
		$data = $this->_mapper->mapAll($results);
		
        return $data;
    }
}