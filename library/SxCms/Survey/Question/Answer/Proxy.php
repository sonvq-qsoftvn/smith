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
