<?php

class SxCms_Page_Picture
{
	protected $_pictureId;
	protected $_pageId;
	protected $_file;
    protected $_text;
	protected $_place;
	protected $_season;
    protected $_language = 'nl';

	public function setPictureId($id)
	{
		$this->_pictureId = (int) $id;
		return $this;
	}

	public function getPictureId()
	{
		return $this->_pictureId;
	}

	public function setPageId($id)
	{
		$this->_pageId = (int) $id;
		return $this;
	}

	public function getPageId()
	{
		return $this->_pageId;
	}

	public function setFile($file)
	{
		$this->_file = $file;
		return $this;
	}

	public function getFile()
	{
		return $this->_file;
	}

    public function setText($text)
	{
		$this->_text = $text;
		return $this;
	}

	public function getText()
	{
		return $this->_text;
	}

	public function setPlace($place)
	{
		$this->_place = $place;
		return $this;
	}

	public function getPlace()
	{
		return $this->_place;
	}

    public function setLanguage($language)
	{
		$this->_language = $language;
		return $this;
	}

	public function getLanguage()
	{
		return $this->_language;
	}

	public function setSeason($season)
	{
		$this->_season = $season;
		return $this;
	}

	public function getSeason()
	{
		return $this->_season;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');


		$data = array(
            'picture_id' => $this->getPictureId(),
			'page_id' => $this->getPageId(),
		    'file' => $this->getFile(),
		    'place' => $this->getPlace(),
			'season' => $this->getSeason()
		);

        if ($this->getPictureId()) {
			$db->update('PagePictures', $data, 'picture_id = ' . $this->getPictureId());
		} else {
			$db->insert('PagePictures', $data);
			$this->setPictureId($db->lastInsertId());
		}

		$tslData = array(
			'picture_id' => $this->getPictureId(),
			'text' => $this->getText(),
		);

		$query = $db->select()
			->from('PagePicturesTsl', 'COUNT(*)')
			->where('picture_id = ?', $this->getPictureId())
			->where('language = ?', $this->getLanguage());

		if ($db->fetchOne($query)) {
			$db->update('PagePicturesTsl', $tslData,
				'picture_id = ' . $this->getPictureId() .
				' AND language = \'' . $this->getLanguage() . '\'');
		} else {
			$config = Zend_Registry::get('config');
			foreach ($config->system->language as $lng => $slng) {
				$tslData['language'] = $lng;
				$db->insert('PagePicturesTsl', $tslData);
			}
		}

		return true;
	}

    public function saveUpdate($lng)
	{
		$db = Zend_Registry::get('db');

        $data = array(
			'picture_id' => $this->getPictureId(),
			'season' => $this->getSeason(),
		);

		$db->update('PagePictures', $data,
                    'picture_id = ' . $this->getPictureId()
                    );

		$tslData = array(
			'picture_id' => $this->getPictureId(),
			'text' => $this->getText(),
		);

		$db->update('PagePicturesTsl', $tslData,
                    'picture_id = ' . $this->getPictureId() .
                    ' AND language = \'' . $lng . '\''
                    );


		return true;
	}


	public function delete()
	{
		if (!$this->getPictureId()) {
			throw new Exception('unique identifier must be set');
		}

		$db = Zend_Registry::get('db');
        return $db->delete('PagePictures', 'picture_id = ' . $this->getPictureId());
	}

    public function order() {
		$db = Zend_Registry::get('db');
		$data = array(
			'place' 	=> $this->getPlace()
		);
		return $db->update('PagePictures', $data, 'picture_id = ' . $this->getPictureId());
	}
}
