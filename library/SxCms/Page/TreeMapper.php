<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: TreeMapper.php 8731 2010-07-14 06:38:34Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */

// Magic. Do not touch.


/**
 * @category   SxCms
 * @package    SxCms_Page_TreeMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Page_TreeMapper
{
	/**
	 * Filename to the XML document
	 *
	 * @var string
	 */
	protected $_filename;

	/**
	 * Reference to XML's DOM
	 *
	 * @var DOMDocument
	 */
	protected $_dom;

	/**
	 * Reference to Xpath for lookups
	 *
	 * @var DOMXpath
	 */
	protected $_xpath;

	/**
	 * Load the datasource with tree mappings
	 *
	 * @param string $filename - Filename to the XML with tree mappings
	 * @throws Exception
	 * @return SxCms_Page_TreeMapper
	 */
	public function loadSource($filename)
	{
		if (!is_readable($filename)) {
			throw new Exception("'$filename' does not appear to be readable");
		}

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXml(file_get_contents($filename));
		$dom->formatOutput = true;

		$this->_filename = $filename;
		$this->_dom   = $dom;
		$this->_xpath = new DOMXpath($this->_dom);

		return $this;
	}

	/**
	 * Add a node at a certain position in the tree
	 *
	 * @param integer $id	  - Id of the node you want to add
	 * @param integer $parent - Id of the parent node the new node should be assigned to
	 * @param string  $name   - The name of the new node
	 * @throws Exception
	 * @return boolean
	 */
	public function add($id, $parent, $name, $position = null, $before = false)
	{
		if (false === ($parentNode = $this->exists($parent))) {
			return $this;
            //throw new Exception('attempted to add a node (' . $id . ') to a none existing node (' . $parent . ')');
		}

		$menu = $this->_dom->createElement('menu');
		$menu->setAttribute('id', $id);
		$menu->setAttribute('name', $name);

		if ($position && $before) {
			if (false === ($posNode = $this->exists($position))) {
                return $this;
				//throw new Exception('attempted to add to a none existing node (' . $position . ')');
			}

			$posNode->parentNode->insertBefore($menu, $posNode);
		} else {
			$parentNode->appendChild($menu);
		}

		return $this;
	}

	/**
	 * Delete a node in the tree
	 *
	 * @param integer $node - Id of the node you wish to delete
	 * @throws Exception
	 * @return SxCms_Page_TreeMapper
	 */
	public function delete($node)
	{
		if (false === ($delNode = $this->exists($node))) {
			return $this;
		}

		$delNode->parentNode
			->removeChild($delNode);

		return $this;
	}

	/**
	 * Moves a node in the tree
	 *
	 * @param integer $node - Id of the node you wish to move
	 * @param integer $to   - Id of the node you wish to move the node to
	 * @throws Exception
	 * @return SxCms_Page_TreeMapper
	 */
	public function move($node, $to, $position = null, $before = false)
	{
		if ($node === 0) {
			return $this;
		}

		if (false === ($moveNode = $this->exists($node))) {
			return $this;
            //throw new Exception('attempted to move a none existing node (' . $node . ')');
		}

		if (false === ($moveToNode = $this->exists($to))) {
			return $this;
            //throw new Exception('attempted to move node (' . $node . ') to a none existing node (' . $to . ')');
		}

		if ($position && $before) {
			if (false === ($posNode = $this->exists($position))) {
				return $this;
                //throw new Exception('attempted to move to a none existing node (' . $to . ')');
			}

			$posNode->parentNode->insertBefore($moveNode, $posNode);
		} else {
			$moveToNode->appendChild($moveNode);
		}

		return $this;
	}

	/**
	 * Get the path to the given node
	 *
	 * @param integer $nodeId - Id of node to get the path for
	 * @throws Exception
	 * @return array
	 */
	public function getPath($nodeId)
	{
		if (false === ($node = $this->exists($nodeId))) {
			return array();
		}
        
		$items = array();
		do {
			$items[] = $node->getAttribute('id');
			$node = $node->parentNode;
		} while ($node->hasAttributes());

		return array_reverse($items);
	}

	/**
	 * Checks if the given node exists in the tree
	 *
	 * @param integer $node - Id of node to check for
	 * @return mixed - DOMElement if node was found, otherwise false
	 */
	public function exists($node)
	{
		$nodeList = $this->_xpath->query("//menu[@id='{$node}']");
		if (!$nodeList->length) {
			return false;
		}

		return $nodeList->item(0);
	}

	/**
	 * Get the depth of a certain node, ie how many levels deep is
	 * the given node nested in the tree
	 *
	 * @param integer $node - Id of the node to get the depth for
	 * @return integer
	 */
	public function getDepth($node)
	{
		return count($this->getPath($node));
	}

	/**
	 * Checks if the given node has child nodes
	 *
	 * @param integer $node - Id of node to check for children
	 * @throws Exception
	 * @return boolean
	 */
	public function hasChildren($node)
	{
		if (false === ($node = $this->exists($node))) {
			return false;
		}

		return $node->hasChildNodes();
	}

	/**
	 * Maps a tree to the XML structure, and returns a resultset
	 * with the tree ordered by the XML structure
	 *
	 * @param array $tree
	 * @return array
	 */
	public function map(Array $tree)
	{
		$nodeList = $this->_xpath->query("//menu");
		$items = array(0);
		foreach ($nodeList as $node) {
			$id = $node->getAttribute('id');
			if (isset($tree[$node->getAttribute('id')])) {
				$items[$id] = $tree[$node->getAttribute('id')];
				$items[$id]->setLevel($this->getDepth($node->getAttribute('id')));
			}
		}

		return $items;
	}

	public function getChildOrder($node)
	{
		if (false === ($node = $this->exists($node))) {
			return array(); 
		}

		$items = array();
		foreach ($node->childNodes as $node) {
			$items[$node->getAttribute('id')] = $node->getAttribute('id');
		}

		return $items;
	}

	/**
	 * Get in memory XML
	 *
	 * @return string
	 */
	public function getXml()
	{
		return $this->_dom->saveHTML();
	}

	/**
	 * Dump the in memory XML back to the file
	 *
	 * @return boolean
	 */
	public function save()
	{
		$this->_dom->save($this->_filename);
		return true;
	}
}
