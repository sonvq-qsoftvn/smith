<?php

class SxCms_View_Helper_Getuser extends Zend_View_Helper_Abstract
{
	public function getuser($user_id = 0)
    {
    	$proxy = new SxCms_User_DataMapper();
    	$user = $proxy->getById($user_id);

    	return $user->getFullName();
    }
}
