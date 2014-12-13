<?php

class SxCms_View_Helper_LuceneIcon extends Zend_View_Helper_Abstract
{
    public function luceneIcon($url)
    {
    	$ext = strtolower(end(explode('.', $url)));
    	switch ($ext) {
    		case 'pptx':
    			$icon = '/images/cms/filetypes/powerpoint.png';
    			break;
    		case 'xlsx':
                $icon = '/images/cms/filetypes/excel.png';
                break;
    		case 'docx':
                $icon = '/images/cms/filetypes/word.png';
                break;
    		case 'pdf':
    			$icon = '/images/cms/filetypes/pdf.png';
    			break;
    		default:
    			$icon = '/images/cms/filetypes/default.png';
    	}

	    return $icon;
    }
}
