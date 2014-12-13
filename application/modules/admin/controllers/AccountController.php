<?php

class Admin_AccountController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->menu = array(
            'template' => 'account/__menu.phtml',
            'active'   => 'menu-account',
            'tab'      => 'account'
        );
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $systemAdmin->lng);
		
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/account.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

	public function indexAction()
	{
		SxCms_Acl::requireAcl('account', 'account.index');

        $proxy = new SxCms_User_DataMapper();
        $users = $proxy->getAllUsers();

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($users));
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $paginator->setItemCountPerPage(15);

        $this->view->paginator = $paginator;
	}

    public function addAction()
    {
    	SxCms_Acl::requireAcl('account', 'account.add');

    	$gMapper = new SxCms_Group_DataMapper();
    	$this->view->groups = $gMapper->getAll();

		$user = new SxCms_User();
		if ($this->getRequest()->isPost()) {
			$user->setEmail($this->_getParam('email'))
				 ->setFirstName($this->_getParam('first_name'))
				 ->setLastName($this->_getParam('last_name'))
				 ->setPassword($this->_getParam('password'));
	
			foreach ($this->_getParam('group') as $groupId) {
				$group = new SxCms_Group();
				$group->setId($groupId);

				$user->addGroup($group);
			
			}

			$validator = new SxCms_User_BaseValidator();
			$validator->setPasswordRepeat($this->_getParam('password_repeat'));
			if ($validator->validate($user)) {
				$user->save();
				$this->_helper->redirector->gotoSimple('index', 'account');
			}
		}

		$this->view->user = $user;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_User');
    }

    public function editAction()
    {
    	SxCms_Acl::requireAcl('account', 'account.edit');

    	$id = $this->_getParam('id');

    	$gMapper = new SxCms_Group_DataMapper();
    	$this->view->groups = $gMapper->getAll();

    	$proxy = new SxCms_User_DataMapper();
    	$user  = $proxy->getById($id);

        if ($this->getRequest()->isPost()) {
            $user->setFirstName($this->_getParam('first_name'))
                 ->setLastName($this->_getParam('last_name'));

            if ($this->_getParam('password') || $this->_getParam('password_repeat')) {
                 $user->setPassword($this->_getParam('password'));
            }
			
   			foreach ($this->_getParam('group') as $groupId) {
				$group = new SxCms_Group();
				$group->setId($groupId);
				
				$user->addGroup($group);
				
			}
	
            $validator = new SxCms_User_UpdateValidator();
            $validator->setOldPassword($this->_getParam('old_password'));
            $validator->setPasswordRepeat($this->_getParam('password_repeat'));
            if ($validator->validate($user)) {
                $user->save();
                $this->_helper->redirector->gotoSimple('index', 'account');
            }
        }

        $this->view->user = $user;
        $this->view->messages = Sanmax_MessageStack::getInstance('SxCms_User');
    }

    public function activateAction()
    {
    	SxCms_Acl::requireAcl('account', 'account.activate');

    	$id = $this->_getParam('id');

    	$proxy = new SxCms_User_DataMapper();
    	$user = $proxy->getById($id);
    	$user->activate();

    	$this->_helper->redirector->gotoSimple('index', 'account');
    }

    public function deleteAction()
    {
    	SxCms_Acl::requireAcl('account', 'account.delete');

    	$user = new SxCms_User();
    	$user->setId($this->_getParam('id'));

		$mapper = new SxCms_User_DataMapper();
		$mapper->delete($user);

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('userdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'account');
    }

    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_helper->redirector->gotoSimple('index', 'index');
    }

	public function loginAction()
	{
		$user = new SxCms_User();

		$config = Zend_Registry::get('config');
		$this->view->sytemadminlng = $config->systemadmin->language->toArray();

		if ($this->getRequest()->isPost()) {
			$user->setEmail($this->_getParam('username'))
				->setPassword($this->_getParam('password'));
			
			$validator = new SxCms_User_LoginValidator();
			if ($validator->validate($user) && $user->login()) {
				$system = new Zend_Session_Namespace('System');
				$system->lng = $config->system->defaults->language;

				$systemAdmin = new Zend_Session_Namespace('SystemAdmin');

				if(array_key_exists($this->_getParam('systemAdminLng',  $config->systemadmin->defaults->language), $config->systemadmin->language->toArray())) {
					$systemAdmin->lng = $this->_getParam('systemAdminLng', $config->systemadmin->defaults->language);
				}
				else {
					$systemAdmin->lng = $config->systemadmin->defaults->language;
				}
				
				$_SESSION['isLoggedIn'] = true;
				$this->_helper->redirector->gotoSimple('index', 'page');
			}
		}

		$this->view->user = $user;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_User');

		if (!$this->getRequest()->getParam('redirect')) {
			$this->_helper->layout->setLayout('login');
		}
	}
}