<?php

class SxCms_View_Helper_Page extends Zend_View_Helper_Abstract
{
    public function Page()
    {
		return $this;
    }

	public function getAll($lng = 'nl')
	{
		$proxy = new SxCms_Page_Proxy();
		return $proxy->getAll($lng);
	}

	public function getById($page_id, $lng = 'nl')
	{
		$proxy = new SxCms_Page_Proxy();
		return $proxy->getPageById($page_id, $lng);
	}
}
