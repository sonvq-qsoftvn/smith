<?php

class SxCms_View_Helper_Excerpt extends Zend_View_Helper_Abstract
{
	public function excerpt($str, $length = 200, $postfix = '[...]')
	{
		$str = trim(strip_tags($str));
		if (strlen($str) > $length) {
			$excerpt = substr($str, 0, $length);
			$p = strrpos($excerpt, ' ');
			if($p === false) {
				return $excerpt . ' ' . $postfix;
			} else {
				return substr($excerpt, 0, $p) . ' ' . $postfix;
			}
		} else {
			return $str;
		}
	}
}
