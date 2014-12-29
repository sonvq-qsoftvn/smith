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