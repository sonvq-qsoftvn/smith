<?php

class SxModule_Faq_Category {

    protected $_id;
    protected $_position;
    protected $_type;
    protected $_dateCreated;
    protected $_dateUpdated;
    protected $_active;
    protected $_picture;
    protected $_lng;
    protected $_title;
    protected $_content;
    protected $_url;
    protected $_description;

    public function getId() {
        if (!isset($this->_id)) {
            return false;
        }
        return $this->_id;
    }

    public function setId($_id) {
        $this->_id = $_id;
    }

    public function getPosition() {
        return $this->_position;
    }

    public function setPosition($_position) {
        $this->_position = $_position;
    }

    public function getType() {
        return $this->_type;
    }

    public function setType($_type) {
        $this->_type = $_type;
    }

    public function getDateCreated() {
        return $this->_dateCreated;
    }

    public function setDateCreated($_dateCreated) {
        $this->_dateCreated = $_dateCreated;
    }

    public function getDateUpdated() {
        return $this->_dateUpdated;
    }

    public function setDateUpdated($_dateUpdated) {
        $this->_dateUpdated = $_dateUpdated;
    }

    public function getActive() {
        return $this->_active;
    }

    public function setActive($_active) {
        $this->_active = $_active;
    }

    public function getPicture() {
        return $this->_picture;
    }

    public function setPicture($_picture) {
        $this->_picture = $_picture;
    }

    public function getLng() {
        return $this->_lng;
    }

    public function setLng($_lng) {
        $this->_lng = $_lng;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function setTitle($_title) {
        $this->_title = $_title;
    }

    public function getContent() {
        return $this->_content;
    }

    public function setContent($_content) {
        $this->_content = $_content;
    }

    public function getUrl() {
        return $this->_url;
    }

    public function setUrl($_url) {
        $this->_url = $_url;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setDescription($_description) {
        $this->_description = $_description;
    }

    /* functions */

    public function validateBetween($value, $name, $tab = 'settings', $min = '2', $max = '255') {
        $validator = new Zend_Validate_StringLength($min, $max);
        $validator->setMessage('Dit is verplicht in te vullen', Zend_Validate_StringLength::TOO_SHORT);
        $validator->setMessage('Oops dit is te lang', Zend_Validate_StringLength::TOO_LONG);
        if ($validator->isValid($value)) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxModule_Faq_Category');
        $msg->addMessage($name, $validator->getMessages(), $tab);
        return false;
    }

    public function validateMinimum($value, $name, $tab = 'settings', $min = '2') {
        $validator = new Zend_Validate_StringLength($min);
        $validator->setMessage('Dit is verplicht in te vullen', Zend_Validate_StringLength::TOO_SHORT);
        if ($validator->isValid($value)) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxModule_Faq_Category');
        $msg->addMessage($name, $validator->getMessages(), $tab);
        return false;
    }

    public function isValid() {
        $this->validateBetween($this->_title, 'title', 'content');
        $this->validateBetween($this->_picture, 'picture', 'content');

        return count(Sanmax_MessageStack::getInstance('SxModule_Faq_Category')->getNamespaceMessages()) == 0;
    }

    public function delete() {
        $id = $this->getId();
        $db = Zend_Registry::get('db');
        $db->delete('FaqCategory', 'id = ' . $id);
        $db->delete('FaqCategoryTsl', 'c_id = ' . $id);
        return true;
    }

    public function activate() {
        $db = Zend_Registry::get('db');
        if($this->_active){
            $active = array('active' => 0);
        }else{
            $active = array('active' => 1);
        }

        $db->update('FaqCategory', $active, 'id = ' . $this->_id);

        return true;
    }

    protected function _createUrl() {
        $title = $this->getTitle();
        $url = strtolower($title);
        $url = preg_replace('%>%', '/', $url);
        $url = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $url);
        $url = preg_replace('%-{2,}%', '-', $url);
        $url = preg_replace('%/{2,}%', '/', $url);
        $url = preg_replace('%(-*)/(-*)%', '/', $url);

        $url = trim($url, '-');
        $url = trim($url, '-');

        return strtolower($url);
    }

    public function createThumbName($name) {
        $names = explode('.', $name);
        $thumbname = str_replace('/', '-', $names[0]);
        $thumbname = preg_replace('%>%', '/', $thumbname);
        $thumbname = preg_replace('%[^a-zA-Z0-9\\-/]%', '-', $thumbname);
        $thumbname = preg_replace('%-{2,}%', '-', $thumbname);
        $thumbname = preg_replace('%/{2,}%', '-', $thumbname);
        $thumbname = preg_replace('%(-*)/(-*)%', '-', $thumbname);

        $thumbname = trim($thumbname, '-');
        $thumbname = trim($thumbname, '-');

        return strtolower($thumbname);
    }

    public function updateRank($rank) {
        $db = Zend_Registry::get('db');
        $rank++;
        $place = array('position' => $rank);
        $db->update('FaqCategory', $place, 'id =' . $this->getId());
    }

    public function save() {
        $db = Zend_Registry::get('db');
        $identity = Zend_Auth::getInstance()->getIdentity();

        $data = array(
            'position' => $this->getPosition(),
            'active' => $this->getActive(),
            'picture' => $this->getPicture()
        );

        if ($this->_id) {
            $data['date_updated'] = new Zend_Db_Expr('NOW()');
            $db->update('FaqCategory', $data, 'id = ' . $this->_id);
            $id = $this->_id;
        } else {
            $data['date_created'] = new Zend_Db_Expr('NOW()');
            $db->insert('FaqCategory', $data);
            $id = $db->lastInsertId();
        }

        $tslData = array(
            'c_id' => $id,
            'lng' => $this->getLng(),
            'title' => $this->getTitle(),
            'url' => $this->_createUrl()
        );

        if ($this->getId() === false) {
            $config = Zend_Registry::get('config');
            foreach ($config->system->language as $lng => $slng) {
                $tslData['lng'] = $lng;
                $db->insert('FaqCategoryTsl', $tslData);
            }
        } else {
            $db->update('FaqCategoryTsl', $tslData, 'c_id = ' . $this->_id .
                    ' AND lng = \'' . $this->getLng() . '\'');
        }

        return $this;
    }

}