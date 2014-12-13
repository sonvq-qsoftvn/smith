<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8218 2010-05-31 07:20:30Z andries $
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
 * @package    SxCms_Profession_DataMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
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
