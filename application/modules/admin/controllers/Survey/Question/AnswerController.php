<?php
class Admin_Survey_Question_AnswerController extends Zend_Controller_Action {
	protected $_survey;
	protected $_questions;

	public function init() {
		if (!isset($_SESSION['Cms_SurveyWizard']['survey'])) {
			$survey = new SxCms_Survey();
			$_SESSION['Cms_SurveyWizard']['survey'] = $survey;
		}
		$this->_survey = &$_SESSION['Cms_SurveyWizard']['survey'];
		$this->_questions = &$this->_survey->getQuestion();
	}

	public function getAnswerAction() {
		$questionId = $this->_getParam('questionId');
		$key = $this->_getParam('key');

		$question = $this->_questions[$questionId];
		$answer = $question->getAnswer($key);

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($answer, TYPE_OBJECT);
		$this->render('json');
	}

	public function addAnswerAction() {
		$questionId = $this->_getParam('questionId');
		$key = $this->_getParam('key');

		if($key != "") {
			$question = $this->_questions[$questionId];
			$answer = $question->getAnswer($key);
		} else {
			$answer = new SxCms_Survey_Question_Answer();
		}

		if($this->getRequest()->isPost()) {
			$answer->setSurveyQuestionId($questionId)
				->setAnswer($this->_getParam('answer'));
			
			if($key != "") {
				$question = $this->_questions[$questionId];
				$question->removeAnswer($key);
			}
			$question = $this->_questions[$answer->getSurveyQuestionId()];
			$question->addAnswer($answer, $key);
		}

		$this->view->survey = $this->_survey;
		$this->_helper->layout()->disableLayout();
		$this->render('answertable');
	}

	public function removeAnswerAction() {
		$questionId = $this->_getParam('questionId');
		$key = $this->_getParam('key');

		$question = $this->_questions[$questionId];
		$question->removeAnswer($key);

		$this->view->survey = $this->_survey;
		$this->_helper->layout()->disableLayout();
		$this->render('answertable');
	}
}
?>