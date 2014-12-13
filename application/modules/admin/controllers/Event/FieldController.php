<?php
class Admin_Event_FieldController extends Zend_Controller_Action
{
	protected $_event;

	public function init()
	{
		$config = Zend_Registry::get('config');
		if (!isset($_SESSION['Cms_EventWizard']['event'])) {
			$event = new SxCms_Event();
			$_SESSION['Cms_EventWizard']['event'] = $event;
		}
		$this->_event = &$_SESSION['Cms_EventWizard']['event'];

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/event.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function getFieldAction()
	{
		$key = $this->_getParam('key');
		$field = $this->_event->getFields($key);

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($field,Zend_Json::TYPE_OBJECT);
		$this->render('json');
	}

	public function getListFieldsAction()
	{
		$fields = $this->_event->getFields();
		foreach($fields as $key => $field) {
			if($field->getType() === 'select' || $field->getType() === 'multiselect' || $field->getType() == 'checkbox' || $field->getType() == 'radio') {
				$fieldlist[] = array(
				    'id' => $key,
				    'name' => $field->getName()
			     );
			}
		}

		$this->_helper->layout()->disableLayout();
		$this->view->data = Zend_Json::encode($fieldlist,Zend_Json::TYPE_ARRAY);
		$this->render('json');
	}

	public function addFieldAction()
	{
		$key = $this->_getParam('key', null);

		if($key != '') {
			$field = $this->_event->getFields($key);
		} else {
			$field = new SxCms_Event_Field;
		}

		if ($this->getRequest()->isPost()) {
			$field->setLabel(trim($this->_getParam('label')))
				->setName(trim($this->_getParam('name')))
				->setType($this->_getParam('type'));
			$this->_event->addFields($field, $key);
		}

		$this->view->event = $this->_event;
		$this->view->field = $field;

		$this->_helper->layout()->disableLayout();
		$this->render('fieldtable');
	}

	public function removeFieldAction()
	{
		$key = $this->_getParam('key');
		$this->_event->removeFields($key);

		$this->view->event = $this->_event;

		$this->_helper->layout()->disableLayout();
		$this->render('fieldtable');
	}
}
