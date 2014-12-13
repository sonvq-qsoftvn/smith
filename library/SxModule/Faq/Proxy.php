<?php
class SxModule_Faq_Proxy {

    public function control($id, $lng) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
		    ->from('FaqTsl', array('*'))
		    ->where('f_id = ?', $id)
		    ->where('lng = ?', $lng);

        $stmt = $db->query($select);
        $result = $stmt->fetch();

        if ($result) {
            return $result;
        }
        else {
            return false;
        }
    }

    public function getById($id, $lng = 'nl', $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
			->from(array('a' => 'Faq'), array('a.*'))
			->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
			->where('a.id = ?', $id)
			->where('t.lng = ?', $lng);

        if ($active) {
            $select->where('a.active = 1');
        }

        $stm = $db->query($select);
        $result = $stm->fetch();
        $item = $this->_map($result);

        return $item;
    }

    public function getAllByParentId($parentID,$lng, $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Faq'), array('a.*'))
                ->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
                ->where('a.parentID = ?',$parentID)
                ->where('t.lng = ?', $lng)
                ->order('a.position ASC');

        if ($active) {
            $select->where('a.active = 1');
        }

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapall($results);

        return $items;
    }

    public function getAllGroupByParent($lng, $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Faq'), array('a.*'))
                ->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
                ->where('t.lng = ?', $lng)
                ->order(array('a.parentID ASC','a.position ASC'));

        if ($active) {
            $select->where('a.active = 1');
        }

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapallperparent($results);

        return $items;
    }

    public function getAll($lng, $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Faq'), array('a.*'))
                ->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
                ->where('t.lng = ?', $lng)
                ->order('a.position ASC');

        if ($active) {
            $select->where('a.active = 1');
        }

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapall($results);

        return $items;
    }

    public function getAllOrderedByType($lng, $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'Faq'), array('a.*'))
                ->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
                ->where('t.lng = ?', $lng)
                ->order('a.position ASC')
                ->order('a.type ASC');

        if ($active) {
            $select->where('a.active = 1');
        }

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapall($results);

        return $items;
    }

    public function search($search, $lng = 'nl') {
        $db = Zend_Registry::get('db');
        $select = $db->select()
	       	->from(array('a' => 'Faq'), array('a.*'))
	        ->join(array('t' => 'FaqTsl'), 'a.id = t.f_id', array('t.*'))
	        ->where('t.lng = "' . $_SESSION['System']['lng'] . '"')
	        ->where('t.title LIKE '.$db->quote('%$search%').' OR t.content LIKE '.$db->quote('%$search%'))
			->where('a.active = 1')
	        ->order('a.position ASC');

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapall($results);

        return $items;
    }

    private function _mapall($results) {
        $items = array();
        foreach ($results as $item) {
            $obj = new SxModule_Faq();
            $obj->setId($item['f_id']);
            $obj->setParentId($item['parentID']);
            $obj->setPosition($item['position']);
            $obj->setDateCreated($item['date_created']);
            $obj->setDateUpdated($item['date_updated']);
            $obj->setActive($item['active']);
            $obj->setLng($item['lng']);
            $obj->setQuestion($item['question']);
            $obj->setAnswer($item['answer']);
            $items[$item['f_id']] = $obj;
        }

        return $items;
    }

    private function _mapallperparent($results) {
        $items = array();
        foreach ($results as $item) {
            $obj = new SxModule_Faq();
            $obj->setId($item['f_id']);
            $obj->setParentId($item['parentID']);
            $obj->setPosition($item['position']);
            $obj->setDateCreated($item['date_created']);
            $obj->setDateUpdated($item['date_updated']);
            $obj->setActive($item['active']);
            $obj->setLng($item['lng']);
            $obj->setQuestion($item['question']);
            $obj->setAnswer($item['answer']);
            $items[$item['parentID']][$item['f_id']] = $obj;
        }

        return $items;
    }

    private function _map($item) {
        $obj = new SxModule_Faq();
        $obj->setId($item['f_id']);
        $obj->setParentId($item['parentID']);
        $obj->setPosition($item['position']);
        $obj->setDateCreated($item['date_created']);
        $obj->setDateUpdated($item['date_updated']);
        $obj->setActive($item['active']);
        $obj->setLng($item['lng']);
        $obj->setQuestion($item['question']);
        $obj->setAnswer($item['answer']);

        return $obj;
    }
}