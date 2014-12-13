<?php

class Admin_Event_SettingsController extends Zend_Controller_Action
{
	public function init()
	{
		$config = Zend_Registry::get('config');
		$this->view->menu = array(
			'tab'	   => 'event',
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-event'
		);

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/event.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction()
	{
		$settings = SxCms_Event_Setting_DataMapper::getAllSettings();

		if ($this->getRequest()->isPost()) {
			foreach($this->_getAllParams() as $key => $value) {
				if(array_key_exists($key, $settings)) {
					$setting = new SxCms_Event_Setting();
					$setting->setVariable($key)
						->setValue($value)
						->setLanguage($_SESSION['System']['lng']);
					$setting->save();
				}
			}
			$flashMessenger = $this->_helper->getHelper('FlashMessenger');
			$flashMessenger->addMessage($this->admin_tmx->_('settingsedited'));

			$this->_helper->redirector->gotoSimple('index', 'event_settings');
		}

		$this->view->settings = $settings;
	}
}
