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

class SxCms_Job_Category_DataMapper
{
    public function toObject(Array $import)
    {
        $fields = array(
            'vacancy_cat_id' => null,
            'parent_id'      => null,
            'language'       => null,
            'name'           => null,
            'description'    => null,
        );

        foreach ($import as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

        $category = new SxCms_Job_Category();
        $category->setId($fields['vacancy_cat_id'])
           ->setParentId($fields['parent_id'])
           ->setLanguage($fields['language'])
           ->setName($fields['name'])
           ->setDescription($fields['description']);

        return $category;
    }
    
	public function getTree()
	{
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('VacancyCat', array('*'))
            ->where('language = ?', $_SESSION['System']['lng'])
            ->order('parent_id ASC');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $categories = array();
        foreach ($result as $pub) {
        	$category = $this->toObject($pub);
        	if (!$category->getParentId()) {
        		$categories[$category->getId()] = $category;
        	} else {
        		$categories[$category->getParentId()]->addSubCategory($category);
        	}
        }

        return $categories;
	}
	
    public function getById($id)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('VacancyCat', array('*'))
            ->where('vacancy_cat_id = ?', $id)
            ->where('language = ?', $_SESSION['System']['lng'])
            ->order('parent_id');

        $stmt = $db->query($select);
        $pub = $stmt->fetch();
        if (!$pub) {
            return new SxCms_Job_Category();
        }

        $category = $this->toObject($pub);
        return $category;
    }

    public function getAll()
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('VacancyCat', array('*'))
            ->where('language = ?', $_SESSION['System']['lng'])
            ->order('parent_id');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $categories = array();
        foreach ($result as $pub) {
        	$category = $this->toObject($pub);
            $categories[$category->getId()] = $category;
        }

        return $categories;
    }
}
