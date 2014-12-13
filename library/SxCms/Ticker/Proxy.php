<?php
class SxCms_Ticker_Proxy
{
	public function getById($id)
	{
    	$db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Ticker')
            ->where('id = ?', $id);

        $stm = $db->query($select);
        $results = $stm->fetchAll();

		$tickers = $this->map($results);

        return current($tickers);
	}

	public function getAll($lng = 'nl')
	{
		$db = Zend_Registry::get('db');

        $select = $db->select()
            ->from('Ticker')
			->where('language = ?', $lng)
            ->order(array('date DESC'));

        $stm = $db->query($select);
        $results = $stm->fetchAll();

		$refs = $this->map($results);

        return $refs;
	}
	
	public function getAllActive($lng = 'nl')
	{
		$db = Zend_Registry::get('db');

        $select = $db->select()
            ->from('Ticker')
			->where("language = '". $lng ."'")
			->where('date >= \'' . date('Y-m-d') . '\'')
            ->order(array('date DESC'));

        $stm = $db->query($select);
        $results = $stm->fetchAll();

		$refs = $this->map($results);

        return $refs;
	}
	
	public function getLatest($limit = 1)
	{
		$db = Zend_Registry::get('db');

        $select = $db->select()
            ->from('Ticker')
            ->order(array('date ASC'))
			->where('date > CURDATE()')
			->limit($limit);
			
		

        $stm = $db->query($select);
        $results = $stm->fetchAll();

		$ticks = $this->map($results);

        return $ticks;
	}
	
	public function getByUrl($url)
	{
		$db = Zend_Registry::get('db');

        $select = $db->select()
            ->from('References')
            ->where("url LIKE '" . $url . "'");

        $stm = $db->query($select);
        $results = $stm->fetchAll();

		$refs = $this->map($results);

        return current($refs);
	}


	

	public function map($results)
	{
		$tickers = array();
        foreach($results as $result) {
	       	$ticker = new SxCms_Ticker();
	       	$ticker->setTickId($result['id'])
	       		->setTitle($result['title'])
	       		->setDate($result['date'])
	       		->setUrl($result['url']);
	       	

	       	$tickers[$result['id']] = $ticker;
        }
        return $tickers;
	}
}