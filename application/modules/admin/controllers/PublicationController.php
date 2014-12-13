<?php

class Admin_PublicationController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->menu = array(
            'template' => 'system/__modules.phtml',
            'active'   => 'menu-publication',
            'tab'      => 'modules',
        );
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
    }

    public function categoriesAction()
    {
    	$mapper = new SxCms_Publication_Category_DataMapper();
    	$categories = $mapper->getAll();

    	$this->view->categories = $categories;
    }

    public function indexAction()
    {
    	$mapperCategory = new SxCms_Publication_Category_DataMapper();
        $category = $mapperCategory->getById($this->_getParam('category'));
		
		if($category->getId() == null)
			$this->_helper->redirector->gotoSimple(
            'categories', 'publication', 'admin', array());

        $mapper = new SxCms_Publication_DataMapper();
        $publications = $mapper->getFromCategory($category);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($publications));
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $paginator->setItemCountPerPage(15);

        $this->view->paginator = $paginator;
    }

    public function addAction()
    {
		$system = new Zend_Session_Namespace('System');
		
        $mapper = new SxCms_Publication_Category_DataMapper();
        $categories = $mapper->getAll();
        $this->view->categories = $categories;

        $publication = new SxCms_Publication();
        $this->view->publication = $publication;
		

        $request = $this->getRequest();
        if ($request->isPost()) {
			$system->lng = $this->_getParam('lang');
        	$category = new SxCms_Publication_Category();
        	$category->setId($request->getParam('category'));

        	$publication->setCategory($category)
        	   ->setName($request->getParam('name'))
        	   ->setDescription($request->getParam('description'))
               ->setContent($request->getParam('content'))
        	   ->setLanguage($system->lng)
        	   ->setPublicationDate($request->getParam('publication_date',date('Y-m-d H:i:s')));

        	$validator = new SxCms_Publication_BaseValidator();
        	if ($validator->validate($publication)) {
        		$publication->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage('Publicatie werd succesvol aangemaakt!');

                $this->_helper->redirector->gotoSimple(
                    'index', 'publication', 'admin', array('category' => $category->getId())
                );
        	}
        }


		
        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Publication');
    }

    public function editAction()
    {
        $mapper = new SxCms_Publication_Category_DataMapper();
        $categories = $mapper->getAll();
        $this->view->categories = $categories;

        $mapper = new SxCms_Publication_DataMapper();
        $publication = $mapper->getById($this->_getParam('id'));
        $this->view->publication = $publication;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $category = new SxCms_Publication_Category();
            $category->setId($request->getParam('category'));

            $publication->setId($request->getParam('id'))
               ->setCategory($category)
               ->setName($request->getParam('name'))
               ->setDescription($request->getParam('description'))
               ->setContent($request->getParam('content'))
               ->setLanguage($_SESSION['System']['lng'])
               ->setPublicationDate($request->getParam('publication_date',date('Y-m-d H:i:s')));

            $validator = new SxCms_Publication_BaseValidator();
            if ($validator->validate($publication)) {
                $publication->save();

                $flashMessenger = $this->_helper->getHelper('FlashMessenger');
                $flashMessenger->addMessage('Publicatie werd succesvol aangepast!');

                $this->_helper->redirector->gotoSimple(
                    'index', 'publication', 'admin', array('category' => $category->getId())
                );
            }
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Publication');
    }

    public function deleteAction()
    {
        $mapper = new SxCms_Publication_DataMapper();
        $publication = $mapper->getById($this->_getParam('id'));
        $publication->delete();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage('Publicatie werd succesvol verwijderd!');

        $this->_helper->redirector->gotoSimple(
            'index', 'publication', 'admin', array('category' => $publication->getCategory()->getId())
        );
    }

    public function deleteDocAction()
    {
        $mapper = new SxCms_Publication_DataMapper();
        $publication = $mapper->getById($this->_getParam('publication'));
        $publication->setFilename('');
        $publication->save();

        $filename = base64_decode($this->_getParam('filename'));
        unlink(APPLICATION_ROOT . '/public_html/publicaties/' . $filename);

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function addCategoryAction()
    {
    	$category = new SxCms_Publication_Category();
    	$this->view->category = $category;

    	if ($this->getRequest()->isPost()) {
    		$category->setName($this->_getParam('name'))
    		  ->setDescription($this->_getParam('description'))
    		  ->setLanguage($_SESSION['System']['lng']);

    	   $validator = new SxCms_Publication_Category_BaseValidator();
    	   if ($validator->validate($category)) {
	    	   $category->save();

               $flashMessenger = $this->_helper->getHelper('FlashMessenger');
               $flashMessenger->addMessage('Categorie werd succesvol aangemaakt!');

	    	   $this->_helper->redirector->gotoSimple('categories', 'publication');
    	   }
    	}

    	$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Publication_Category');
    }

    public function editCategoryAction()
    {
    	$mapper = new SxCms_Publication_Category_DataMapper();
        $category = $mapper->getById($this->_getParam('id'));

        $this->view->category = $category;

        if ($this->getRequest()->isPost()) {
            $category->setId($this->_getParam('id'))
              ->setName($this->_getParam('name'))
              ->setDescription($this->_getParam('description'))
              ->setLanguage($_SESSION['System']['lng']);

           $validator = new SxCms_Publication_Category_BaseValidator();
           if ($validator->validate($category)) {
               $category->save();

               $flashMessenger = $this->_helper->getHelper('FlashMessenger');
               $flashMessenger->addMessage('Categorie werd succesvol aangepast!');

               $this->_helper->redirector->gotoSimple('categories', 'publication');
           }
        }

        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Publication_Category');
    }

    public function deleteCategoryAction()
    {
        $mapper = new SxCms_Publication_Category_DataMapper();
        $category = $mapper->getById($this->_getParam('id'));
        $category->delete();

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage('Categorie werd succesvol verwijderd!');

        $this->_helper->redirector->gotoSimple('categories', 'publication');
    }
}
