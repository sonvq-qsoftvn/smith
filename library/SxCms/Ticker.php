<?php
class SxCms_Ticker {
	
	protected $_tickId;
	protected $_language;
	protected $_title;
	protected $_date;
	protected $_url;

	public function setTickId($id)
	{
		$this->_tickId = (int) $id;
		return $this;
	}
	
	public function getTickId()
	{
		return $this->_tickId;
	}
	
	public function setLanguage($lng)
	{
		$this->_language = $lng;
		return $this;
	}
	
	public function getLanguage()
	{
		return $this->_language;	
	}

	public function setTitle($title)
	{
		$this->_title = $title;
		return $this;
	}
	
	public function getTitle()
	{
		return $this->_title;
	}

	public function setDate($date)
	{
		$this->_date = $date;
		return $this;
	}
	
	public function getDate($format = null)
	{
		if(is_null($this->_date) || strlen($this->_date) == 0)
			return strftime($format);
		if ($format)
			return strftime($format, strtotime($this->_date));
		return $this->_date;
	}
	
	public function setUrl($url)
	{
		$this->_url = $url;
		return $this;
	}
	
	public function getUrl()
	{
		return $this->_url;
	}

	public function isValid()
	{
        return count(Sanmax_MessageStack::getInstance('AktuaInvest_Project')
                ->getNamespaceMessages()) == 0;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');

		$data = array('title' => $this->getTitle(),
					  'url' => $this->getUrl(),
					  'date' => $this->getDate('%Y-%m-%d'),
					  'language' => $this->getLanguage());

		if (!$this->getTickId()) {
			$db->insert('Ticker', $data);
		} else {
			$db->update('Ticker', $data, 'id = ' . $this->getTickId());
		}
		return true;
	}
	
	public function delete()
	{
		$db = Zend_Registry::get('db');
        return $db->delete('Ticker', 'id = ' . $this->getTickId());
	}

	
}