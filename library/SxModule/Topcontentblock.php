<?php

class SxModule_Topcontentblock
{
	protected $_tmx;

	protected $_id;
	protected $_blockname;
	protected $_title;
	protected $_content;
	protected $_lng;
	protected $_url;
	protected $_picture;
    protected $_thumb;

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function getId() {
		return $this->_id;
	}
	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	public function getPicture() {
		return $this->_picture;
	}
	public function setPicture($_picture) {
		$this->_picture = $_picture;
	}

	public function getBlockname() {
		return $this->_blockname;
	}
	public function setBlockname($blockname) {
		$this->_blockname = $blockname;
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

	public function getUrl() {
		return $this->_url;
	}
	public function setUrl($url) {
		$this->_url = $url;
		return $this;
	}

    public function getThumb() {
		return $this->_thumb;
	}
	public function setThumb($thumb) {
		$this->_thumb = $thumb;
		return $this;
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

	public function save($params = '*', $tsl_params = '*') {
		
		$db = Zend_Registry::get('db');
		$mapper = new SxModule_Topcontentblock_Mapper();

		$data = $mapper->toArray($this, 'item');
		$tslData = $mapper->toArray($this, 'tsl');

		if(is_array($params)) {
			$data = $mapper->fromInput($data, $params);
		}

		if(is_array($tsl_params)) {
			$tslData = $mapper->fromInput($tslData, $tsl_params);
		}
		
		if($this->getId()) {
			$tslData['lng'] = $_SESSION['System']['lng'];
			$db->update('TopcontentBlocks', $data, 'id = ' . (int)$this->getId());
			$db->update('TopcontentBlocksTsl', $tslData, 'b_id = ' . (int)$this->getId() . ' AND lng = ' . $db->quote($_SESSION['System']['lng']));
		}
		else {
			$db->insert('TopcontentBlocks', $data);
			$this->setId($db->lastInsertId());

			$config = Zend_Registry::get('config');
			foreach($config->system->language as $lng => $slng) {
				$tslData['lng'] = $lng;
				$tslData['b_id'] = (int)$this->getId();
				$db->insert('TopcontentBlocksTsl', $tslData);
			}
		}

		return $this;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('TopcontentBlocks', 'id = ' . (int)$this->getId());
		$db->delete('TopcontentBlocksTsl', 'b_id = ' . (int)$this->getId());

		return true;
	}
    
    public function updateRank($rank) {
        $db = Zend_Registry::get('db');
        $rank++;
        $place = array('position' => $rank);
        $db->update('TopcontentBlocks', $place, 'id =' . $this->getId());
    }

}
