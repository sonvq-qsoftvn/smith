<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8780 2010-07-22 13:23:44Z andries $
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
 * @package    SxCms_Job_DataMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Job_DataMapper
{
	public function getModelFromArray(Array $data)
	{
		$fields = array(
		    'author_id'   => null,
            'vacancy_id'  => null,
            'title'       => null,
            'description' => null,
            'phone'       => null,
		    'mobile'      => null,
            'email'       => null,
		    'term'        => null,
            'region'      => null,
		    'category_id' => null,
		    'hours'       => null,
		    'seeker_name'    => null,
		    'seeker_fname'   => null,
		    'date_expired'   => null,
		    'date_published' => null,
		);

		foreach ($data as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
		}

        $vacancy = new SxCms_Job();
        $vacancy->setId($fields['vacancy_id'])
                ->setJobtitle($fields['title'])
                ->setDescription($fields['description'])
                ->setPhone($fields['phone'])
                ->setMobile($fields['mobile'])
                ->setEmail($fields['email'])
                ->setTerm($fields['term'])
                ->setSeekerFirstName($fields['seeker_name'])
                ->setSeekerName($fields['seeker_fname']);

        $address = new SxCms_Address();
        $address->setRegion($fields['region']);

        $category = new SxCms_Job_Category();
        $category->setId($fields['category_id']);
        $vacancy->setCategory($category);

        $vacancy->setAddress($address)
                ->setHours($fields['hours'])
                ->setExpireDate($fields['date_expired'])
                ->setPublicationDate($fields['date_published']);

        return $vacancy;
	}

	public function getAllJobs()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Vacancy', array('*'));

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$jobs = array();
		foreach ($result as $job) {
			$vacancy = $this->getModelFromArray($job);
			$jobs[$vacancy->getId()] = $vacancy;
		}

		return $jobs;
	}

    public function getActiveJobs($category = null)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array('*'))
            ->where('date_published <= CURDATE()')
            ->where('date_expired >= CURDATE()')
            ->order('date_expired');

        if ($category) {
            $select->where('category_id = ?', (int) $category);
        }

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $jobs = array();
        foreach ($result as $job) {
            $vacancy = $this->getModelFromArray($job);
            $jobs[$vacancy->getId()] = $vacancy;
        }

        return $jobs;
    }

    public function getArchivedJobs($year, $month)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array('*'))
            ->where('date_expired <= NOW()')
            ->where("DATE_FORMAT(date_expired, '%Y') = ?", $year)
            ->where("DATE_FORMAT(date_expired, '%m') = ?", $month)
            ->order('date_expired');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $jobs = array();
        foreach ($result as $job) {
            $vacancy = $this->getModelFromArray($job);
            $jobs[$vacancy->getId()] = $vacancy;
        }

        return $jobs;
    }

    public function getArchivedJobYears()
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array("DATE_FORMAT(date_expired, '%Y') AS date"))
            ->where('date_expired <= NOW()')
            ->order('date_expired')
            ->group('date');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $years = array();
        foreach ($result as $row) {
            $years[] = $row['date'];
        }

        return $years;
    }

    public function getArchivedJobMonths($year)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array("DATE_FORMAT(date_expired, '%m') AS date"))
            ->where('date_expired <= NOW()')
            ->where("DATE_FORMAT(date_expired, '%Y') = ?", new Zend_Db_Expr('YEAR(NOW())'))
            ->order('date_expired')
            ->group('date');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $months = array();
        foreach ($result as $row) {
        	$months[] = $row['date'];
        }

        return $months;
    }

	public function getByCat(SxCms_Job_Category $category)
	{
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array('*'))
            ->where('date_published <= CURDATE()')
            ->where('date_expired >= CURDATE()')
            ->order('date_published DESC');

        if ($category->getId()) {
        	$select->where('category_id = ?', $category->getId());
        }

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $jobs = array();
        foreach ($result as $job) {
            $vacancy = $this->getModelFromArray($job);
            $jobs[$vacancy->getId()] = $vacancy;
        }

        return $jobs;
	}

	public function getDistinctRegions()
	{
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array('DISTINCT(region) AS region'))
            ->order('region ASC');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $regions = array();
        foreach ($result as $region) {
            $address = new SxCms_Address();
            $address->setRegion($region['region']);

            $regions[] = $address;
        }

        return $regions;
	}

	public function getAllActiveJobs()
	{
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Vacancy', array('*'))
            ->where('date_published <= CURDATE()')
            ->where('date_expired >= CURDATE()')
            ->order('date_published DESC');

        $stmt = $db->query($select);
        $result = $stmt->fetchAll();

        $jobs = array();
        foreach ($result as $job) {
            $vacancy = $this->getModelFromArray($job);
            $jobs[$vacancy->getId()] = $vacancy;
        }

        return $jobs;
	}
}