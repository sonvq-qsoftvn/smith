<?php

class Admin_VacancyController extends Zend_Controller_Action
{
	protected $_vacancy;

	public function init()
	{
		if (!isset($_SESSION['Cms_VacancyWizard']['vacancy'])) {
			$vacancy = new SxCms_Job();
			$_SESSION['Cms_VacancyWizard']['vacancy'] = $vacancy;
		}

		$this->_vacancy   = $_SESSION['Cms_VacancyWizard']['vacancy'];
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-vacancy',
			'tab'      => 'modules',
		);
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
		
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
	}

	public function initializeAction()
	{
		$this->_vacancy->setId($this->_getParam('id'));
		$this->_vacancy->loadState();

		$goto = str_replace('.', '/', $this->_getParam('go'));
		$this->_redirect($goto);
	}

	public function indexAction()
	{
		SxCms_Acl::requireAcl('vacancy', 'vacancy.index');

		$proxy = new SxCms_Job_DataMapper();
		if ($this->_getParam('year') && $this->_getParam('month')) {
			$jobs = $proxy->getArchivedJobs($this->_getParam('year'), $this->_getParam('month'));
			$this->view->year  = $this->_getParam('year');
			$this->view->month = $this->_getParam('month');
		} else {
            $jobs= $proxy->getActiveJobs($this->_getParam('category'));
		}

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($jobs));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function archiveAction()
	{
        $proxy = new SxCms_Job_DataMapper();
        if (!$this->_getParam('year')) {
            $years = $proxy->getArchivedJobYears();
            $this->view->years = $years;
        }

        if ($this->_getParam('year')) {
        	$months = $proxy->getArchivedJobMonths($this->_getParam('year'));
        	$this->view->months = $months;
        	$this->view->year   = $this->_getParam('year');
        }
	}

	public function addAction()
	{
		SxCms_Acl::requireAcl('vacancy', 'vacancy.add');

		$mapper = new SxCms_Job_DataMapper();
		$regions = $mapper->getDistinctRegions();
		$this->view->regions = $regions;

		$mapper = new SxCms_Job_Category_DataMapper();
		$this->view->categories = $mapper->getTree();

		$job = new SxCms_Job();
		if ($this->getRequest()->isPost()) {
			$jobMapper = new SxCms_Job_DataMapper();
			$job = $jobMapper->getModelFromArray($_POST);

			$validator = new SxCms_Job_BaseValidator();
			if ($validator->validate($job)) {
				$job->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Vacature werd succesvol aangemaakt!');

                $this->_helper->redirector->gotoSimple('index', 'vacancy');
			}
		}

		$this->view->job = $job;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Job');
	}

	public function editAction()
	{
		SxCms_Acl::requireAcl('vacancy', 'vacancy.edit');

        $mapper = new SxCms_Job_DataMapper();
        $regions = $mapper->getDistinctRegions();
        $this->view->regions = $regions;

        $mapper = new SxCms_Job_Category_DataMapper();
        $this->view->categories = $mapper->getTree();

		$job = $this->_vacancy;
		if ($this->getRequest()->isGet()) {
			$pubDate = new DateTime();
			$expDate = clone $pubDate;
			$expDate->modify('+3 months');
			
			$job->setPublicationDate($pubDate->format('Y-m-d'));
			$job->setExpireDate($expDate->format('Y-m-d'));
		}
		
		if ($this->getRequest()->isPost()) {
            $jobMapper = new SxCms_Job_DataMapper();
            $job = $jobMapper->getModelFromArray($_POST);
            $job->setId($this->_vacancy->getId());

			$validator = new SxCms_Job_BaseValidator();
			if ($validator->validate($job)) {
				$job->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Vacature werd succesvol aangepast!');

				$this->_helper->redirector->gotoSimple('index', 'vacancy', null, array('page' => $this->_getParam('page')));
			}
		}

		$this->view->job = $job;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Job');
	}

	public function deleteAction()
	{
		SxCms_Acl::requireAcl('vacancy', 'vacancy.delete');

		if ($this->_vacancy->getId() === false) {
			$this->_helper->redirector->gotoSimple('index', 'vacancy');
		}

		$this->_vacancy->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Vacature werd succesvol verwijderd!');

		$this->_helper->redirector->gotoSimple('index', 'vacancy', null, array('page' => $this->_getParam('page')));
	}

    public function categoriesAction()
    {
        $mapper = new SxCms_Job_Category_DataMapper();
        $categories = $mapper->getTree();

        $this->view->categories = $categories;
    }

    public function addCategoryAction()
    {
        $category = new SxCms_Job_Category();
        $this->view->category = $category;

		$mapper = new SxCms_Job_Category_DataMapper();
		$this->view->categories = $mapper->getTree();

        if ($this->getRequest()->isPost()) {
            $category->setName($this->_getParam('name'))
              ->setParentId($this->_getParam('parent'))
              ->setDescription($this->_getParam('description'))
              ->setLanguage($_SESSION['System']['lng']);

           $validator = new SxCms_Job_Category_BaseValidator();
           if ($validator->validate($category)) {
               $category->save();

               $flashMessenger = $this->_helper->getHelper('FlashMessenger');
               $flashMessenger->addMessage('Categorie werd succesvol aangemaakt!');

               $this->_helper->redirector->gotoSimple('categories', 'vacancy');
           }
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Job_Category');
    }

    public function editCategoryAction()
    {
        $mapper = new SxCms_Job_Category_DataMapper();
        $category = $mapper->getById($this->_getParam('id'));

        $this->view->category = $category;

		$mapper = new SxCms_Job_Category_DataMapper();
		$this->view->categories = $mapper->getAll();

        if ($this->getRequest()->isPost()) {
            $category->setId($this->_getParam('id'))
              ->setName($this->_getParam('name'))
              ->setParentId($this->_getParam('parent'))
              ->setDescription($this->_getParam('description'))
              ->setLanguage($_SESSION['System']['lng']);

           $validator = new SxCms_Job_Category_BaseValidator();
           if ($validator->validate($category)) {
               $category->save();

               $flashMessenger = $this->_helper->getHelper('FlashMessenger');
               $flashMessenger->addMessage('Categorie werd succesvol aangepast!');

               $this->_helper->redirector->gotoSimple('categories', 'vacancy');
           }
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Job_Category');
    }

    public function deleteCategoryAction()
    {
        $mapper = new SxCms_Job_Category_DataMapper();
        $category = $mapper->getById($this->_getParam('id'));
        $category->delete();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage('Categorie werd succesvol verwijderd!');

        $this->_helper->redirector->gotoSimple('categories', 'vacancy');
    }
}
