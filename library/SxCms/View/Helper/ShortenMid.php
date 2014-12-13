<?php

class SxCms_View_Helper_ShortenMid extends Zend_View_Helper_Abstract
{
    public function shortenMid($value, $lenght = 200)
    {
	    if (strlen($value) >= $lenght ){
	        $lenght_max = ($lenght/2)-3;
	        $start = strlen($value)- $lenght_max;
	        $limited = substr($value,0,$lenght_max);
	        $limited.= " ... ";
	        $limited.= substr($value,$start,$lenght_max);
	    }
	    else{
	        $limited = $value;
	    }
	    return $limited;
    }
}
