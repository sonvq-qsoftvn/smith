<?php

class Admin_Survey_QuestionController extends Zend_Controller_Action
{
	protected $_survey;

	public function init()
	{
		if (!isset($_SESSION['Cms_SurveyWizard']['survey'])) {
			$survey = new SxCms_Survey();
			$_SESSION['Cms_SurveyWizard']['survey'] = $survey;
		}

		$this->_survey = &$_SESSION['Cms_SurveyWizard']['survey'];
	}

	public function getQuestionAction()
	{
		$key = $this->_getParam('key');
		$question = $this->_survey->getQuestion($key);

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($question, TYPE_OBJECT);
		$this->render('json');
	}

	public function getListQuestionsAction()
	{
		$questions = $this->_survey->getQuestion();
		foreach($questions as $key => $question) {
			if($question->getType() === 'select' || $question->getType() === 'multiselect') {
				$questionlist[] = array(
				    'id' => $key,
				    'question' => $question->getQuestion()
				);
			}
		}

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($questionlist, Zend_Json::TYPE_ARRAY);
		$this->render('json');
	}

	public function addQuestionAction()
	{
		$key = $this->_getParam('key', null);
		if ($key != '') {
			$question = $this->_survey->getQuestion($key);
		} else {
			$question = new SxCms_Survey_Question();
		}

		if($this->getRequest()->isPost()) {
			$question->setQuestion($this->_getParam('question'))
				->setType($this->_getParam('type'))
				->setComment($this->_getParam('comment'));
			$this->_survey->addQuestion($question, $key);
		}

		$this->view->survey = $this->_survey;
		$this->view->question = $question;

		$this->_helper->layout()->disableLayout();
		$this->render('questiontable');
	}

	public function removeQuestionAction()
	{
		$key = $this->_getParam('key');
		$this->_survey->removeQuestion($key);

		$this->view->survey = $this->_survey;

		$this->_helper->layout()->disableLayout();
		$this->render('questiontable');
	}
}
