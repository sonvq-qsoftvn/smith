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
 * @package    SxCms_Survey_Question_Answer_Proxy
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Survey_Question_Answer_Proxy
{
	public function getAnswerByQuestion(SxCms_Survey_Question $question)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('sqa' => 'SurveyQuestionAnswer'), array('*'))
			->where('sqa.survey_question_id = ?', $question->getId());

		$results = $db->fetchAll($select);

		foreach($results as $result) {
			$answer = new SxCms_Survey_Question_Answer();
			$answer->setId($result['answer_id'])
                ->setSurveyQuestionId($result['survey_question_id'])
                ->setAnswer($result['answer']);

			$question->addAnswer($answer, $result['answer_id']);
		}

		return;
	}
}
