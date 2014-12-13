<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 9962 2010-12-02 11:01:34Z mindy $
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
 * @package    SxCms_Publication_DataMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Publication_DataMapper
{
    public function toObject(Array $import)
    {
        $fields = array(
            'publication_id'     => null,
            'publication_cat_id' => null,
            'language'           => null,
            'name'               => null,
            'description'        => null,
            'content'            => null,
            'publication_date'   => null,
        );

        foreach ($import as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

        $category = new SxCms_Publication_Category();
        $category->setId($fields['publication_cat_id']);

        $publication = new SxCms_Publication();
        $publication->setId($fields['publication_id'])
           ->setLanguage($fields['language'])
           ->setName($fields['name'])
           ->setDescription($fields['description'])
           ->setContent($fields['content'])
           ->setPublicationDate($fields['publication_date'])
           ->setCategory($category);

        return $publication;
    }
    
    public function getFromCategory(SxCms_Publication_Category $cat)
    {
    	$lng = isset($_SESSION['System']['lng']) ? $_SESSION['System']['lng'] : 'nl';

        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Publication', array('*'))
            ->where('language = ?', $lng)
            ->where('publication_cat_id = ?', $cat->getId())
            ->order('publication_date DESC');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $publications = array();
        foreach ($result as $pub) {
            $publication = $this->toObject($pub);
            $publications[$publication->getId()] = $publication;
        }

        return $publications;
    }

    public function getById($id)
    {
    	$lng = isset($_SESSION['System']['lng']) ? $_SESSION['System']['lng'] : 'nl';

        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Publication', array('*'))
            //->where('language = ?', $lng)
            ->where('publication_id = ?', $id);

        $stmt = $db->query($select);
        $pub = $stmt->fetch();

        $publication = $this->toObject($pub);
        return $publication;
    }

    public function getAll()
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Publication', array('*'))
            ->where('language = ?', $_SESSION['System']['lng'])
            ->order('publication_id DESC');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $publications = array();
        foreach ($result as $pub) {
            $publication = $this->toObject($pub);
            $publications[$publication->getId()] = $publication;
        }

        return $publications;
    }
}
