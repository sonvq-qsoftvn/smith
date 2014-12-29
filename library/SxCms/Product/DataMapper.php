<?php

/**
 * Development by thieusmith
 * @version $Id: Acl.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. thieusmith can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Acl
 * @copyright  Copyright (c) 2015 thieusmith. (thieusmith@gmail.com)
 */
class SxCms_Product_DataMapper
{
	public function getAllProducts($categoryId = null, $language = 'nl')
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Product'), array('*'))
			->joinLeft(array('t' => 'ProductTsl'), 'p.product_id = t.product_id')
			->where('t.language LIKE "' . $language . '"');

		if ($categoryId !== null) {
			$select->where('p.category_id = ?', $categoryId);
		}

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$products = array();
		foreach ($result as $product) {
			$category = new SxCms_Product_Category();
			$category->setId($product['category_id'])
					->setLanguage($_SESSION['System']['lng']);
			$category->loadState();

			$productObj = new SxCms_Product();
			$productObj->setId($product['product_id'])
				->setLanguage($product['language'])
				->setTitle($product['title'])
				->setDescription($product['description'])
				->setSummary($product['summary'])
				->setPrice($product['price'])
				->setCategory($category);

			$products[$product['product_id']] = $productObj;
		}

		return $products;
	}
}