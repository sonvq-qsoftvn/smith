<?php

class SxCms_View_Helper_Errors extends Zend_View_Helper_Abstract
{
	protected $_key;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function getClass($key)
    {
		return isset($this->view->errors[$key]) ? 'error' : 'default';
    }

    public function errors($key = null)
    {
        if ($key === null) {
            return $this;
        }

        if (!isset($this->view->errors[$key])) {
            return null;
        }

    	$messages = $this->view->errors[$key];
    	if (!count($messages)) {
			return null;
    	}

    	$html = '<ul class="errors">';
    	foreach ($messages as $values) {
    		if (null !== $key) {
				$html .= '<li>' . $values . '</li>';
    		} else {
    			foreach ($values as $value) {
    				$html .= '<li>' . $value . '</li>';
    			}
    		}
    	}

    	$html .= '</ul>';
    	return $html;
    }
}