<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Question.php 8237 2010-05-31 14:41:11Z andries $
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
class SxCms_Survey_Question
{
    /**
     * Unique identifier
     * @var integer
     */
	public $id;

    /**
     * Survey identifier
     * @var integer
     */
	public $surveyId;

    /**
     * Language identifier
     * @var string
     */
	public $language = 'nl';

    /**
     * Survey's question
     * @var string
     */
	public $question;

    /**
     * Question type
     * @var string
     */
	public $type;
	public $comment;

    /**
     * Possible answers for this question
     * @var array
     */
	public $answers = array();

    /**
     * Sets the unique identifier
     * 
     * @param  $id
     * @return SxCms_Survey_Question
     */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

    /**
     * Return the unique identifier
     * 
     * @return bool|int
     */
	public function getId()
	{
		if (!isset($this->id)) {
			return false;
		}

		return $this->id;
	}

	public function setSurveyId($surveyId)
    {
		$this->surveyId = (int) $surveyId;
		return $this;
	}

	public function getSurveyId()
    {
		return $this->surveyId;
	}

	public function setLanguage($language)
	{
		$this->language = $language;
		return $this;
	}

	public function getLanguage()
	{
		return $this->language;
	}

	public function setQuestion($question)
	{
		$this->question = $question;
		return $this;
	}

	public function getQuestion()
	{
		return $this->question;
	}

	public function setType($type)
    {
		$this->type = $type;
		return $this;
	}

	public function getType()
    {
		return $this->type;
	}

	public function setComment($comment)
	{
		$this->comment = $comment;
		return $this;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function addAnswer(SxCms_Survey_Question_Answer $answer, $key = null)
	{
		if ($key) {
			$this->answers[$key] = $answer;
		}

	    $this->answers[] = $answer;
		return $this;
	}

	public function removeAnswer($key)
	{
		unset($this->answers[$key]);
		return $this;
	}

	public function getAnswer($key = null)
	{
		if ($key) {
			return $this->answers[$key];
		}

        return $this->answers;
	}

	public function validateAnswer()
	{
		if (count($this->answers) < 2) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('answers', array('required' => 'Gelieve minstens 2 antwoorden op te geven voor de vraag: ' . $this->getQuestion()), 'answers');
            
			return false;
		}
        
		return true;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');

		/* save field */
		$questionData = array(
            'survey_id' => $this->getSurveyId(),
            'language'  => $this->getLanguage(),
            'question'  => $this->getQuestion(),
            'type'      => $this->getType(),
            'comment'   => $this->getComment()
		);

		if ($this->getId()) {
			$questionData['survey_id'] = $this->getId();
		}

		$db->insert('SurveyQuestion', $questionData);
		$surveyQuestionId = $db->lastInsertId();

		/* save lists */
		foreach ($this->getAnswer() as $answer) {
			$answer->setSurveyQuestionId($surveyQuestionId);
			$answer->save();
		}
	}

	public function delete()
    {
		$db = Zend_Registry::get('db');
		$db->delete('SurveyQuestion', 'question_id = ' . $this->getId() );

		foreach ($this->getAnswer() as $answer) {
			$answer->delete();
		}
	}
}
