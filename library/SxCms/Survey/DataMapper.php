<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8237 2010-05-31 14:41:11Z andries $
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
 * @package    SxCms_Survey_Question
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Survey_DataMapper
{
	public function getSurveyById($survey_id)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('s' => 'Survey'), array('*'))
			->where('s.survey_id = ?', $survey_id)
			->where('s.language = ?', $_SESSION['System']['lng']);

		$results = $db->fetchAll($select);
		$result	= $results[0];

		$date_published = split(' ', $result['date_published']);
		$date_expired = split(' ', $result['date_expired']);

		$survey = new SxCms_Survey();
		$survey->setId($result['survey_id'])
			->setLanguage($result['language'])
			->setTitle($result['title'])
			->setDescription($result['description'])
			->setDatePublished($date_published[0])
			->setTimePublished($date_published[1])
			->setDateExpired($date_expired[0])
			->setTimeExpired($date_expired[1]);

		$proxy = new SxCms_Survey_Question_Proxy();
		$proxy->getQuestionBySurvey($survey);

		return $survey;
	}

	public function getAllSurveys()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('s' => 'Survey'), array('*'))
			->where('s.language = ?', $_SESSION['System']['lng']);

		$stmt = $db->query($select);
		$results = $stmt->fetchAll();

		$surveys = array();
		foreach($results as $result) {
			$datePublished = split(' ', $result['date_published']);
			$dateExpired   = split(' ', $result['date_expired']);

			$survey = new SxCms_Survey();
			$survey->setId($result['survey_id'])
				->setLanguage($result['language'])
				->setTitle($result['title'])
				->setDescription($result['description'])
				->setDatePublished($datePublished[0])
				->setTimePublished($datePublished[1])
				->setDateExpired($dateExpired[0])
				->setTimeExpired($dateExpired[1]);
            
			$surveys[] = $survey;
		}
        
		return $surveys;
	}

	public function getMaxId()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('s' => 'Survey'), array('max(survey_id) AS max_id'));

		$result = $db->fetchRow($select);
		return ++$result['max_id'];
	}
}
