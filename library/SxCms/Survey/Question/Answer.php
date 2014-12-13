<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Answer.php 8234 2010-05-31 14:13:40Z andries $
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
 * @package    SxCms_Survey_Question_Answer
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Survey_Question_Answer
{
	public $_id;
	public $_surveyQuestionId;
	public $_answer;

	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}

	public function getId()
	{
		if (!isset($this->_id)) {
			return false;
		}

		return $this->_id;
	}

	public function setSurveyQuestionId($surveyQuestionId)
	{
		$this->_surveyQuestionId = (int) $surveyQuestionId;
		return $this;
	}

	public function getSurveyQuestionId()
	{
		return $this->_surveyQuestionId;
	}

	public function setAnswer($answer)
	{
		$this->_answer = $answer;
		return $this;
	}

	public function getAnswer()
	{
		return $this->_answer;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');
		$answerData = array(
            'survey_question_id' => $this->getSurveyQuestionId(),
            'answer' => $this->getAnswer()
		);

		if ($this->getId()) {
			$answerData['answer_id'] = $this->getId();
		}

		$db->insert('SurveyQuestionAnswer', $answerData);
	}

	public function delete()
	{
		$db = Zend_Registry::get('db');
		$db->delete('SurveyQuestionAnswer', 'answer_id = ' . $this->getId());
	}
}
