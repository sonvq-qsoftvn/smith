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
class SxCms_Job_Profession_DataMapper
{
    public function getById($id)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('VacancyProf', array('*'))
            ->where('vacancy_prof_id = ?', $id)
            ->where('language = ?', $_SESSION['System']['lng']);

        $stmt = $db->query($select);
        $pub = $stmt->fetch();

		$profession = new SxCms_Job_Profession();
		$profession->setId($pub['vacancy_prof_id'])
		   ->setLanguage($pub['language'])
		   ->setName($pub['name'])
		   ->setDescription($pub['description']);

        return $profession;
    }

    public function getAll()
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('VacancyProf', array('*'))
            ->where('language = ?', $_SESSION['System']['lng']);

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $professions = array();
        foreach ($result as $pub) {
        	$profession = new SxCms_Job_Profession();
        	$profession->setId($pub['vacancy_prof_id'])
        	   ->setLanguage($pub['language'])
        	   ->setName($pub['name'])
        	   ->setDescription($pub['description']);

            $professions[$profession->getId()] = $profession;
        }

        return $professions;
    }
}
