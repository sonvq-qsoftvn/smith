<?php

class Sanmax_MessageStack
{
	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	private static $_instance;

	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	protected $_namespace = 'default';

	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	protected $_messages = array();

	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	protected $_tabs = array();

	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	public static function getInstance($namespace = 'default') {
        if (!isset(self::$_instance[$namespace])) {
            $c = __CLASS__;
            self::$_instance[$namespace] = new $c;
        }

        return self::$_instance[$namespace]->setNamespace($namespace);
	}

	/**
	 * Enter description here...
	 *
	 * @param unknown_type $namespace
	 * @return unknown
	 */
	public function setNamespace($namespace = 'default') {
		$this->_namespace = $namespace;
		return $this;
	}

	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	public function getNamespace() {
		return $this->_namespace;
	}

	public function reset()
	{
		$this->_messages[$this->_namespace] = array();
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $key
	 * @param unknown_type $messages
	 * @return unknown
	 */
	public function addMessage($key, $messages = array(), $tab = null) {
        if (!isset($this->_messages[$this->_namespace])) {
            $this->_messages[$this->_namespace] = array();
        }

        if (null !== $tab) {
        	if (!isset($this->_tabs[$this->_namespace])) {
        		$this->_tabs[$this->_namespace] = array();
        	}

            if (!isset($this->_tabs[$this->_namespace][$tab])) {
        		$this->_tabs[$this->_namespace][$tab] = array();
        	}

            if (is_array($key)) {
	        	$this->_tabs[$this->_namespace][$tab] += $key;
	        } else {
	        	if (!isset($this->_tabs[$this->_namespace][$tab][$key])) {
	        		$this->_tabs[$this->_namespace][$tab][$key] = array();
	        	}

	        	$this->_tabs[$this->_namespace][$tab][$key] += $messages;
	        }
        }

        if (is_array($key)) {
        	$this->_messages[$this->_namespace] += $key;
        } else {
        	if (!isset($this->_messages[$this->_namespace][$key])) {
        		$this->_messages[$this->_namespace][$key] = array();
        	}

        	$this->_messages[$this->_namespace][$key] += $messages;
        }

        return $this;
	}

	public function getTabMessages($tab)
	{
    	if (!isset($this->_tabs[$this->_namespace][$tab])) {
    		return array();
    	}

       	if (isset($this->_tabs[$this->_namespace][$tab])) {
    		return $this->_tabs[$this->_namespace][$tab];
    	}

    	return array();
	}

	/**
	 * Enter description here...
	 *
	 * @param unknown_type $key
	 * @return unknown
	 */
    public function getMessages($key)
    {
    	if (!isset($this->_messages[$this->_namespace])) {
    		return array();
    	}

       	if (isset($this->_messages[$this->_namespace][$key])) {
    		return $this->_messages[$this->_namespace][$key];
    	}

    	return array();
    }

    /**
     * Enter description here...
     *
     * @return unknown
     */
    public function getNamespaceMessages() {
       	if (!isset($this->_messages[$this->_namespace])) {
    		return array();
    	}

    	return $this->_messages[$this->_namespace];
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $key
     * @return unknown
     */
    public function getMessagesHtml($key) {
    	$messages = $this->getMessages($key);
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
