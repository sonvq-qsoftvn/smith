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
class SxCms_Survey
{
	/**
	 * Unique identifier
	 * @var integer
	 */
	protected $id;

	/**
	 * Language identifier
	 * @var string
	 */
	protected $language = 'nl';

	/**
	 * Title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Description of the suvery
	 * @var string
	 */
	protected $description = '';

	/**
	 * Date the survey is published
	 * @var string
	 */
	protected $datePublished;

	/**
	 * Time the survey is published
	 * @var string
	 */
	protected $timePublished;

	/**
	 * Date the survey has expired
	 * @var string
	 */
	protected $dateExpired;

	/**
	 * Time the survey will be expired
	 * @var string
	 */
	protected $timeExpired;

	/**
	 * Questions assigned to this survey
	 * @var array
	 */
	protected $questions = array();

	/**
	 * Sets the unique identifier
	 *
	 * @param integer $id
	 * @return SxCms_Survey
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

	/**
	 * Gets the unique identifier
	 *
	 * @return mixed
	 */
	public function getId()
	{
		if (!isset($this->id)) {
			return false;
		}

		return $this->id;
	}

	/**
	 * Sets the language identifier
	 *
	 * @param string $language
	 * @return SxCms_Survey
	 */
	public function setLanguage($language)
	{
		$this->language = (string) $language;
		return $this;
	}

	/**
	 * Gets the language identifier
	 *
	 * @return string
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return SxCms_Survey
	 */
	public function setTitle($title)
	{
		$this->title = (string) $title;
		return $this;
	}

	/**
	 * Gets the title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Validate titles
	 *
     * @todo refactor into seperate validation object
	 * @return boolean
	 */
	public function validateTitle()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if (!$validator->isValid($this->title)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('title', $validator->getMessages(), 'survey');
			return false;
		}

		return true;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return SxCms_Survey
	 */
	public function setDescription($description)
	{
		$this->description = (string) $description;
		return $this;
	}

	/**
	 * Gets the description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Validates the description
	 *
     * @todo refactor into seperate validation object
	 * @return boolean
	 */
	public function validateDescription()
	{
		$validator = new Zend_Validate_StringLength(2);
		if (!$validator->isValid($this->description)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('description', $validator->getMessages(), 'survey');

			return false;
		}

		return true;
	}

    /**
     * Sets the date the survey was published
     * 
     * @param  $datePublished
     * @return SxCms_Survey
     */
	public function setDatePublished($datePublished)
	{
		$this->datePublished = (string) $datePublished;
		return $this;
	}

    /**
     * Gets the date on which teh survey was published
     * 
     * @param  $format
     * @return string
     */
	public function getDatePublished($format = null)
	{
		if (is_null($this->datePublished) || strlen($this->datePublished) == 0) {
			return;
        }
        
		if ($format) {
			return strftime($format, strtotime($this->datePublished));
        }
        
		return $this->datePublished;
	}

    /**
     * Validates the publication date
     *
     * @todo refactor into seperate validation object
     * @return bool
     */
	public function validateDatePublished()
	{
		if (!isset($this->datePublished) || empty($this->datePublished)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('datePublished', array('required' => 'Datum is verplicht'), 'survey');

            return false;
		}
        
		return true;
	}

    /**
     * Sets the time on which the survey was published
     *
     * @param  $timePublished
     * @return SxCms_Survey
     */
	public function setTimePublished($timePublished)
	{
		$this->timePublished = $timePublished;
		return $this;
	}

    /**
     * Returns the time on which the survey was published
     * 
     * @param  $format
     * @return string
     */
	public function getTimePublished($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->timePublished));
		}
        
		return $this->timePublished;
	}

    /**
     * Sets the date on which the survey will expire
     *
     * @param  $dateExpired
     * @return SxCms_Survey
     */
	public function setDateExpired($dateExpired)
	{
		$this->dateExpired = $dateExpired;
		return $this;
	}

    /**
     * Returns the date on which teh survey will expire
     *
     * @param  $format
     * @return string
     */
	public function getDateExpired($format = null)
	{
		if (is_null($this->dateExpired) || strlen($this->dateExpired) == 0) {
			return;
        }

		if ($format) {
			return strftime($format, strtotime($this->dateExpired));
        }
        
		return $this->dateExpired;
	}

    /**
     * Validates the date on which the survey will expire
     *
     * @todo refactor into seperate validation object
     * @return bool
     */
	public function validateDateExpired()
	{
		if (!isset($this->dateExpired) || empty($this->dateExpired)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('dateExpired', array('required' => 'Datum is verplicht'), 'survey');

			return false;
		}
        
		return true;
	}

    /**
     * Sets the time on which the survey will expire
     *
     * @param  $timeExpired
     * @return SxCms_Survey
     */
	public function setTimeExpired($timeExpired)
	{
		$this->timeExpired = $timeExpired;
		return $this;
	}

    /**
     * Gets the time on which the survey will/expire
     * 
     * @param  $format
     * @return string
     */
	public function getTimeExpired($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->timeExpired));
		}

		return $this->timeExpired;
	}

    /**
     * Returns the current date?
     *
     * @todo this can't be right?
     * @return string
     */
	public function getDateCreated()
	{
		return strftime("%Y-%m-%d %H:%M:%S");
	}

    /**
     * Returns the current logged in user
     *
     * @todo this can't be right?
     * @return integer
     */
	public function getAuthor()
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
		return $identity->getId();
	}

    /**
     * Adds a question to the stack
     * 
     * @param SxCms_Survey_Question $question
     * @param  $key
     * @return SxCms_Survey
     */
	public function addQuestion(SxCms_Survey_Question $question, $key = null)
	{
		if ($key) {
			$this->questions[$key] = $question;
		} else {
			$this->questions[] = $question;
		}

		return $this;
	}

    /**
     * Removes a question by key
     * 
     * @param  $key
     * @return SxCms_Survey
     */
	public function removeQuestion($key)
	{
		foreach($this->questions[$key]->getAnswer() as $key1 => $question) {
			$this->questions[$key]->removeAnswer($key1);
		}

		unset($this->questions[$key]);
		return $this;
	}

    /**
     * Get a question by key, or a list of all questions
     * 
     * @param  $key
     * @return array
     */
	public function getQuestion($key = null)
	{
		if ($key) {
			return $this->questions[$key];
		}

        return $this->questions;
	}

    /**
     * Validates if survey has at least 1 question
     *
     * @todo refactor into seperate validator object
     * @return bool
     */
	public function validateQuestion()
	{
		if (count($this->questions) < 1) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Survey');
			$msg->addMessage('questions', array('required' => 'Gelieve minstens 1 vraag op te geven') , 'questions');

			return false;
		}

		return true;
	}

    /**
     * Validates the survey object
     *
     * @todo refactor into seperate validator object
     * @return bool
     */
	public function isValid()
	{
		$this->validateTitle();
		$this->validateDescription();
		$this->validateDatePublished();
		$this->validateDateExpired();
		$this->validateQuestion();
        
		$questions = $this->getQuestion();
		foreach($questions as $question) {
			if ($question->getType() === 'select' || $question->getType === 'multiselect') {
				$question->validateAnswer();
			}
		}

		return count(Sanmax_MessageStack::getInstance('SxCms_Survey')
				->getNamespaceMessages()) == 0;
	}

    /**
     * Save survey on datastorage
     * 
     * @return void
     */
	public function save()
	{
		$db = Zend_Registry::get('db');
		$config = Zend_Registry::get('config');

		$surveyData = array(
            'language'       => $this->getLanguage(),
			'title'          => $this->getTitle(),
			'description'    => $this->getDescription(),
			'date_published' => $this->getDatePublished('%Y-%m-%d') . ' ' . $this->getTimePublished('%H:%M:%S'),
			'date_expired'   => $this->getDateExpired('%Y-%m-%d')   . ' ' . $this->getTimeExpired('%H:%M:%S'),
			'date_created'   => $this->getDateCreated(),
			'author_id'      => $this->getAuthor()
		);

		$survey_id = $this->getId() ? $this->getId() : SxCms_Survey_DataMapper::getMaxId();
		if ($this->getId() === false) {
			foreach ($config->system->language as $lng => $slng) {
				$surveyData['survey_id'] = $survey_id;
				$surveyData['language'] = $lng;
				$db->insert('Survey', $surveyData);
			}
		} else {
			$db->update('Survey', $surveyData,
				'survey_id = ' . $survey_id .
				' AND language = \'' . $this->getLanguage()  . '\'');
		}

		if ($this->getId()) {
			$tmpSurvey = SxCms_Survey_DataMapper::getSurveyById($survey_id);
			foreach($tmpSurvey->getQuestion() as $question) {
				$question->delete();
			}
		}

		if ($this->getId() === false) {
			$lngs = $config->system->language;
		} else {
			$lngs[$this->getLanguage()] = null;
		}

        // create translations
		foreach ($lngs as $lng => $slng) {
			foreach($this->getQuestion() as $question) {
				$question->setSurveyId($survey_id);
				$question->setLanguage($lng);
				$question->save();
			}
		}
	}

    /**
     * Delete survey on the datastorage
     * 
     * @return void
     */
	public function delete()
	{
		$db = Zend_Registry::get('db');
		$db->delete('Survey', 'survey_id = ' . $this->getId() .
						' AND language = \'' . $_SESSION['System']['lng'] . '\'');

		foreach($this->getQuestion() as $question) {
			$question->delete();
		}
	}
}
