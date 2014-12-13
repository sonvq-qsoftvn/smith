<?php

class Admin_SurveyController extends Zend_Controller_Action
{
	protected $_survey;

	public function init()
	{
		if (!isset($_SESSION['Cms_SurveyWizard']['survey'])) {
			$survey = new SxCms_Survey();
			$_SESSION['Cms_SurveyWizard']['survey'] = $survey;
		}
        
		$this->_survey = &$_SESSION['Cms_SurveyWizard']['survey'];
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-survey',
			'tab' => 'modules'
		);
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
	}

	public function indexAction()
	{
		SxCms_Acl::requireAcl('survey', 'survey.index');

		$proxy = new SxCms_Survey_DataMapper();
		$surveys = $proxy->getAllSurveys();

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($surveys));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function addAction()
	{
		SxCms_Acl::requireAcl('survey', 'survey.add');

		if ($this->getRequest()->isGet()) {
			$this->_survey = new SxCms_Survey();
		}

		if ($this->getRequest()->isPost()) {
			$timePublished = $this->_getParam('timePublishedH')
				. ':' . $this->_getParam('timePublishedI') . ':00';
			$timeExpired = $this->_getParam('timeExpiredH')
				. ':' . $this->_getParam('timeExpiredI') . ':00';

			$this->_survey->SetTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'))
				->setDatePublished($this->_getParam('datePublished'))
				->setTimePublished($timePublished)
				->setDateExpired($this->_getParam('dateExpired'))
				->setTimeExpired($timeExpired);

			/* validate post */
			if ($this->_survey->isValid()) {
				$this->_survey->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Enquête werd succesvol aangemaakt!');

				$this->_helper->redirector->gotoSimple('index', 'survey');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Survey');
		$this->view->survey = $this->_survey;
		$this->view->question = new SxCms_Survey_Question();
		$this->view->answer = new SxCms_Survey_Question_Answer();
	}

	public function editAction()
	{
		SxCms_Acl::requireAcl('survey', 'survey.edit');

		if ($this->getRequest()->isGet()) {
			$survey_id = (int) $this->_getParam('id');

			$proxy = new SxCms_Survey_DataMapper();
			$this->_survey = $proxy->getSurveyById($survey_id);
		}

		if ($this->getRequest()->isPost()) {
			$timePublished = $this->_getParam('timePublishedH')
				. ':' . $this->_getParam('timePublishedI') . ':00';
			$timeExpired = $this->_getParam('timeExpiredH')
				. ':' . $this->_getParam('timeExpiredI') . ':00';

			$this->_survey->SetTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'))
				->setDatePublished($this->_getParam('datePublished'))
				->setTimePublished($timePublished)
				->setDateExpired($this->_getParam('dateExpired'))
				->setTimeExpired($timeExpired);

			/* validate post */
			if ($this->_survey->isValid()) {
				$this->_survey->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Enquête werd succesvol aangepast!');

				$this->_helper->redirector->gotoSimple('index', 'survey');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Survey');
		$this->view->survey   = $this->_survey;
		$this->view->question = new SxCms_Survey_Question();
		$this->view->answer   = new SxCms_Survey_Question_Answer();
	}

	public function deleteAction()
	{
		SxCms_Acl::requireAcl('survey', 'survey.delete');

		$surveyId = $this->_getParam('id');

		$proxy = new SxCms_Survey_DataMapper();

		$this->_survey = $proxy->getSurveyById($surveyId);
		$this->_survey->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Enquête werd succesvol verwijderd!');

		$this->_helper->redirector->gotoSimple('index', 'survey');
	}
}
