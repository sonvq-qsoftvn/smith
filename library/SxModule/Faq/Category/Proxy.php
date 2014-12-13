<?php

class SxModule_Faq_Category_Proxy {

    public function control($id, $lng) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from('FaqCategoryTsl', array('*'))
                ->where('c_id = ?', $id)
                ->where('lng = ?', $lng);

        $stmt = $db->query($select);
        $result = $stmt->fetch();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getById($id, $lng = 'nl', $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'FaqCategory'), array('a.*'))
                ->join(array('t' => 'FaqCategoryTsl'), 'a.id = t.c_id', array('t.*'))
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

    public function getAll($lng, $active = false) {
        $db = Zend_Registry::get('db');
        $select = $db->select()
                ->from(array('a' => 'FaqCategory'), array('a.*'))
                ->join(array('t' => 'FaqCategoryTsl'), 'a.id = t.c_id', array('t.*'))
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
                ->from(array('a' => 'FaqCategory'), array('a.*'))
                ->join(array('t' => 'FaqCategoryTsl'), 'a.id = t.c_id', array('t.*'))
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
               ->from(array('a' => 'FaqCategory'), array('a.*'))
                ->join(array('t' => 'FaqCategoryTsl'), 'a.id = t.c_id', array('t.*'))
                ->where('t.lng = ?', $_SESSION['System']['lng'])
				->where('t.title LIKE '.$db->quote('%$search%').' OR t.content LIKE '.$db->quote('%$search%'))
                ->order('a.position ASC');
        $select->where('a.active = 1');

        $stm = $db->query($select);
        $results = $stm->fetchAll();
        $items = $this->_mapall($results);

        return $items;
    }

    private function _mapall($results) {
        $items = array();
        foreach ($results as $item) {
            $obj = new SxModule_Faq_Category();
            $obj->setId($item['c_id']);
            $obj->setPosition($item['position']);
            $obj->setDateCreated($item['date_created']);
            $obj->setDateUpdated($item['date_updated']);
            $obj->setActive($item['active']);
            $obj->setPicture($item['picture']);
            $obj->setLng($item['lng']);
            $obj->setTitle($item['title']);
            $obj->setUrl($item['url']);
            $items[$item['c_id']] = $obj;
        }

        return $items;
    }

    private function _map($item) {
        $obj = new SxModule_Faq_Category();
        $obj->setId($item['c_id']);
        $obj->setPosition($item['position']);
        //$obj->setType($item['type']);
        $obj->setDateCreated($item['date_created']);
        $obj->setDateUpdated($item['date_updated']);
        $obj->setActive($item['active']);
        $obj->setPicture($item['picture']);
        $obj->setLng($item['lng']);
        $obj->setTitle($item['title']);
        //$obj->setContent($item['content']);
        $obj->setUrl($item['url']);
        
        return $obj;
    }

}