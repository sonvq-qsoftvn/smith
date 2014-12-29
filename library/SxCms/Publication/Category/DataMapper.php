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
class SxCms_Publication_Category_DataMapper
{
    public function getById($id)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('PublicationCat', array('*'))
            ->where('publication_cat_id = ?', $id)
            ->where('language = ?', $_SESSION['System']['lng']);

        $stmt = $db->query($select);
        $pub = $stmt->fetch();

		$publication = new SxCms_Publication_Category();
		$publication->setId($pub['publication_cat_id'])
		   ->setLanguage($pub['language'])
		   ->setName($pub['name'])
		   ->setDescription($pub['description']);

        return $publication;
    }

    public function getAll()
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('PublicationCat', array('*'))
            ->where('language = ?', $_SESSION['System']['lng']);

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $publications = array();
        foreach ($result as $pub) {
        	$publication = new SxCms_Publication_Category();
        	$publication->setId($pub['publication_cat_id'])
        	   ->setLanguage($pub['language'])
        	   ->setName($pub['name'])
        	   ->setDescription($pub['description']);

            $publications[$publication->getId()] = $publication;
        }

        return $publications;
    }
}
