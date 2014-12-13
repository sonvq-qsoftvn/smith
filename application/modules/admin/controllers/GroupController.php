<?php

class Admin_GroupController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->menu = array(
            'template' => 'account/__menu.phtml',
            'active'   => 'menu-group',
            'tab'      => 'account'
        );
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');

		$errortranslations = APPLICATION_ROOT . '/application/var/locale/errors.tmx';
		$this->tmx = new Zend_Translate('tmx', $errortranslations, $systemAdmin->lng);
		
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/group.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }

	public function indexAction()
	{
		SxCms_Acl::requireAcl('group', 'group.index');

		$mapper = new SxCms_Group_DataMapper();
		$this->view->groups = $mapper->getAll();
	}

	public function addAction()
	{
		SxCms_Acl::requireAcl('group', 'group.add');

		$group = new SxCms_Group();
		if ($this->getRequest()->isPost()) {
			$group->setName($this->_getParam('name'))
				  ->setIdentifier($this->_getParam('identifier'));

			$acl = $group->getAcl();
			$acl->addRole(new Zend_Acl_Role($group->getName()));

			foreach ($this->_getParam('acl') as $resourceId => $priveleges) {
				if (!$acl->has($resourceId)) {
					$acl->add(new Zend_Acl_Resource($resourceId));
				}

				$acl->allow($group->getName(), $resourceId, $priveleges);
			}

			$group->setAcl($acl);

			$validator = new SxCms_Group_BaseValidator();
			if ($validator->validate($group)) {
				$mapper = new SxCms_Group_DataMapper();
				$mapper->save($group);

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('usergroupsaved'));

				$this->_helper->redirector->gotoSimple('index', 'group');
			}
		}

		$xml = simplexml_load_file(APPLICATION_PATH . '/var/acl-resources.xml');
		$this->view->acl = $xml;

		$this->view->group = $group;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Group');
	}

	public function editAction()
	{
		SxCms_Acl::requireAcl('group', 'group.edit');

		$mapper = new SxCms_Group_DataMapper();
		$group = $mapper->getById($this->_getParam('id'));

		if ($this->getRequest()->isPost()) {
			$group->setId($this->_getParam('id'))
				  ->setName($this->_getParam('name'))
				  ->setIdentifier($this->_getParam('identifier'));

			$acl = $group->getAcl();
			$acl->removeRole($group->getName());
			$acl->addRole(new Zend_Acl_Role($group->getName()));

			foreach ($this->_getParam('acl') as $resourceId => $priveleges) {
				if (!$acl->has($resourceId)) {
					$acl->add(new Zend_Acl_Resource($resourceId));
				}

				$acl->allow($group->getName(), $resourceId, $priveleges);
			}

			$group->setAcl($acl);

			$validator = new SxCms_Group_BaseValidator();
			if ($validator->validate($group)) {
				$mapper = new SxCms_Group_DataMapper();
				$mapper->save($group);

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('usergroupsaved'));

				$this->_helper->redirector->gotoSimple('index', 'group');
			}
		}

		$xml = simplexml_load_file(APPLICATION_PATH . '/var/acl-resources.xml');
		$this->view->acl = $xml;

		$this->view->group = $group;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Group');
	}

	public function deleteAction()
	{
		SxCms_Acl::requireAcl('group', 'group.delete');

		$group = new SxCms_Group();
		$group->setId($this->_getParam('id'));

		$mapper = new SxCms_Group_DataMapper();
		$mapper->delete($group);

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('usergroupdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'group');
	}
}