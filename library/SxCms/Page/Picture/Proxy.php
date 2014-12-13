<?php

class SxCms_Page_Picture_Proxy
{
	public function getAllByPage($page = null, $season = '0', $language = 'nl')
	{
    	$db = Zend_Registry::get('db');
        $select	= $db->select()
                     ->from(array('p' => 'PagePictures'), array('*'))
                     ->joinLeft(array('t' => 'PagePicturesTsl'), 'p.picture_id = t.picture_id')
                     ->where('p.page_id = ?', $page)
                     ->where('t.language LIKE "' . $language . '"');

		if($season != 0) {
			$select->where('p.season = 0 OR p.season = ?', $season);
		}

		$select->order(array('place ASC','page_id DESC'));

        $stm		= $db->query($select);
        $pictures	= $stm->fetchAll();

        return $pictures;
	}

    public function getSingleByPage($page = null, $language = 'nl')
	{
    	$db = Zend_Registry::get('db');
        $select	= $db->select()
                     ->from(array('p' => 'PagePictures'), array('*'))
                     ->joinLeft(array('t' => 'PagePicturesTsl'), 'p.picture_id = t.picture_id')
                     ->where('p.page_id = ?', $page)
                     ->order(array('p.place ASC','p.page_id DESC'))
                     ->limit(1);

        $stm		= $db->query($select);
        $pictures	= $stm->fetchAll();

        return $pictures;
	}

	public function getSingle($id, $language = 'nl')
	{
		$db		= Zend_Registry::get('db');
		$select	= $db->select()
			->from(array('p' => 'PagePictures'), array('*'))
            ->joinLeft(array('t' => 'PagePicturesTsl'), 'p.picture_id = t.picture_id')
			->where('p.picture_id = ?', $id);

		$stm	= $db->query($select);
		$row	= current($stm->fetchAll());

		$picture = new SxCms_Page_Picture();
		$picture->setPictureId($row['picture_id'])
			->setPageId($row['page_id'])
            ->setFile($row['file'])
			->setText($row['text'])
			->setPlace($row['place'])
			->setSeason($row['season']);

		return $picture;
	}

    public function countByPage($page = null)
    {
        $db = Zend_Registry::get('db');
        $select	= $db->select()
                     ->from('PagePictures', (array('count(*) as total')))
                     ->where('page_id = ?', $page)
                     ->order(array('place ASC','page_id DESC'));

        $stm		= $db->query($select);
        $rows =  $stm->fetchAll();

        return($rows[0]['total']);
    }
}
