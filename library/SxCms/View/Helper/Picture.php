<?php

class SxCms_View_Helper_Picture extends Zend_View_Helper_Abstract
{
    public function Picture() {
		return $this;
    }

	public function getByPageId($page_id, $lng = 'nl') {
		$proxy = new SxCms_Page_Picture_Proxy();
		return $proxy->getAllByPage($page_id, 0, $lng);
	}
}
