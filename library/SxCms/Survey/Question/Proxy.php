<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Proxy.php 8237 2010-05-31 14:41:11Z andries $
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
 * @package    SxCms_Survey_Question_Proxy
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Survey_Question_Proxy
{
	public function getQuestionBySurvey(SxCms_Survey $survey)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('sq' => 'SurveyQuestion'), array('*'))
			->where('sq.survey_id = ?', $survey->getId())
			->where('sq.language = ?', $survey->getLanguage());

		$results = $db->fetchAll($select);

		foreach($results as $result) {
			$question = new SxCms_Survey_Question();
			$question->setId($result['question_id'])
                ->setSurveyId($result['survey_id'])
                ->setLanguage($result['language'])
                ->setQuestion($result['question'])
                ->setType($result['type'])
                ->setComment($result['comment']);
            
			$survey->addQuestion($question, $result['question_id']);

			$proxy = new SxCms_Survey_Question_Answer_Proxy();
			$proxy->getAnswerByQuestion($question);
		}

		return;
	}
}
