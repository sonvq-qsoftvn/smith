<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: TreeMapper.php 8235 2010-05-31 14:23:48Z andries $
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


/**
 * @category   SxCms
 * @package    SxCms_Product_Category_TreeMapper
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Product_Category_TreeMapper extends SxCms_Page_TreeMapper
{
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
			if (!isset($tree[$node->getAttribute('id')])) {
				continue;
			}

			$items[$id] = $tree[$node->getAttribute('id')];
			$items[$id]->setLevel($this->getDepth($node->getAttribute('id')));
		}

		return $items;
	}
}
