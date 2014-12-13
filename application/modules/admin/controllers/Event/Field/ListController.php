<?php

class Admin_Event_Field_ListController extends Zend_Controller_Action
{
	protected $_event;
	protected $_fields;

	public function init()
	{
		$config = Zend_Registry::get('config');
		if (!isset($_SESSION['Cms_EventWizard']['event'])) {
			$event = new SxCms_Event();
			$_SESSION['Cms_EventWizard']['event'] = $event;
		}

		$this->_event = &$_SESSION['Cms_EventWizard']['event'];
		$this->_fields = &$this->_event->getFields();

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/event.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function getListAction()
	{
		$fieldId = $this->_getParam('fieldId');
		$key = $this->_getParam('key');

		$field = $this->_fields[$fieldId];
		$list = $field->getList($key);

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($list,Zend_Json::TYPE_OBJECT);
		$this->render('json');
	}

	public function addListAction()
	{
		$fieldId = $this->_getParam('fieldId');
		$key = $this->_getParam('key');

		if ($key != '') {
			$field = $this->_fields[$fieldId];
			$list = $field->getList($key);
		} else {
			$list = new SxCms_Event_Field_List();
		}

		if ($this->getRequest()->isPost()) {
			$list->setEventFieldId($this->_getParam('fieldId'))
				->setLabel(trim($this->_getParam('label')))
				->setValue(trim($this->_getParam('value')));

			if (!Sanmax_MessageStack::getInstance('SxCms_Event_Field_List')->getNamespaceMessages()) {
				if($key != "") {
					$field = $this->_fields[$fieldId];
					$field->removeList($key);
				}
				$field = $this->_fields[$list->getEventFieldId()];
				$field->addList($list, $key);
			}
		}

		$this->view->event = $this->_event;
		$this->view->list = $list;

		$this->_helper->layout()->disableLayout();
		$this->render('listtable');
	}

	public function removeListAction()
	{
		$fieldId = $this->_getParam('fieldId');
		$key = $this->_getParam('key');

		$field = $this->_fields[$fieldId];
		$field->removeList($key);

		$this->view->event = $this->_event;
		$this->_helper->layout()->disableLayout();
		$this->render('listtable');
	}
}
