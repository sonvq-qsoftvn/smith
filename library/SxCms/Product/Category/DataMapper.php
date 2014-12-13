<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8235 2010-05-31 14:23:48Z andries $
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
 * @package    SxCms_Product_Category_DataMapper
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Product_Category_DataMapper
{
	public function getAllCategories($language = 'nl')
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('c' => 'Category'), array('*'))
			->joinLeft(array('t' => 'CategoryTsl'), 'c.category_id = t.category_id')
			->where('t.language LIKE "' . $language . '"');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$categories = array();
		foreach ($result as $category) {
			$categoryObj = new SxCms_Product_Category();
			$categoryObj->setId($category['category_id'])
				->setLanguage($category['language'])
				->setTitle($category['title'])
				->setDescription($category['description']);

			$categories[$category['category_id']] = $categoryObj;
		}

		return $categories;
	}

    public function getMainCategories($language = 'nl')
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from(array('c' => 'Category'), array('*'))
            ->join(array('t' => 'CategoryTsl'), 'c.category_id = t.category_id')
            ->where('t.language LIKE "' . $language . '"')
            ->where('c.parent_id = 0 AND c.category_id != 0');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $categories = array();
        foreach ($result as $category) {
            $categoryObj = new SxCms_Product_Category();
            $categoryObj->setId($category['category_id'])
                ->setLanguage($category['language'])
                ->setTitle($category['title'])
                ->setDescription($category['description']);

            $categories[$category['category_id']] = $categoryObj;
        }

        return $categories;
    }

    public function getSubCategories($parentId, $language = 'nl')
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from(array('c' => 'Category'), array('*'))
            ->join(array('t' => 'CategoryTsl'), 'c.category_id = t.category_id')
            ->where('t.language LIKE "' . $language . '"')
            ->where('c.parent_id = ' . $parentId . ' AND c.category_id != 0');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $categories = array();
        foreach ($result as $category) {
            $categoryObj = new SxCms_Product_Category();
            $categoryObj->setId($category['category_id'])
                ->setLanguage($category['language'])
                ->setTitle($category['title'])
                ->setDescription($category['description']);

            $categories[$category['category_id']] = $categoryObj;
        }

        return $categories;
    }
}