<?php

class Admin_EventController extends Zend_Controller_Action
{
	protected $_event;

	public function init() {
		if(!isset($_SESSION['Cms_EventWizard']['event'])) {
			$event = new SxCms_Event();
			$_SESSION['Cms_EventWizard']['event'] = $event;
		}

		$this->_event = &$_SESSION['Cms_EventWizard']['event'];
		$this->view->menu = array(
			'tab' => 'event',
			'template' => 'system/__modules.phtml',
			'active' => 'menu-event'
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;

		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/event.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);

		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
	}

	public function indexAction() {
		SxCms_Acl::requireAcl('event', 'event.index');

		$proxy = new SxCms_Event_DataMapper();
		$events = $proxy->getNextEvents(false);

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($events));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function archiveAction() {
		SxCms_Acl::requireAcl('event', 'event.archive');

		$proxy = new SxCms_Event_DataMapper();
		$events = $proxy->getPrevEvents();

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($events));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function addAction() {
		SxCms_Acl::requireAcl('event', 'event.add');

		$mapper = new SxCms_Event_DataMapper();
		$regions = $mapper->getDistinctRegions();
		$this->view->regions = $regions;

		if($this->getRequest()->isGet()) {
			$this->_event = new SxCms_Event();
			$settings = SxCms_Event_Setting_DataMapper::getAllSettings();
			$this->_event->setMailConfirmation($settings['mailConfirmation']->getValue())->setMailRemember($settings['mailRemember']->getValue());
		}

		if($this->getRequest()->isPost()) {

			$this->_event->setSubscriptionAllow($this->_getParam('subscriptionAllow'))->setSubscriptionMax($this->_getParam('subscriptionMax'))->setNotifyEmail($this->_getParam('notifyEmail'))->setDateStart($this->_getParam('dateStart'))->setDateEnd($this->_getParam('dateEnd'))->setRememberDays($this->_getParam('rememberDays'))->setConfirmationLink($this->_getParam('confirmationLink'))->setValidateIntern($this->_getParam('validateIntern'));

			$timeEvent = $this->_getParam('datetimeH') . ':' . $this->_getParam('datetimeI') . ':00';
			$this->_event->setDateEvent($this->_getParam('dateEvent'))->setTimeEvent($timeEvent)->setLocation($this->_getParam('location'))->setTitle($this->_getParam('title'))->setDescription($this->_getParam('description'));

			$this->_event->setMailRemember($this->_getParam('mailRemember'))->setMailConfirmation($this->_getParam('mailConfirmation'));

			if($this->_event->isValid()) {
				$this->_event->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('eventcreated'));

				$this->_helper->redirector->gotoSimple('index', 'event');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Event');
		$this->view->event = $this->_event;
		$this->view->field = new SxCms_Event_Field();
		$this->view->list = new SxCms_Event_Field_List();
	}

	public function editAction() {
		SxCms_Acl::requireAcl('event', 'event.edit');

		$mapper = new SxCms_Event_DataMapper();
		$regions = $mapper->getDistinctRegions();
		$this->view->regions = $regions;

		if($this->getRequest()->isGet()) {
			$event_id = (int)$this->_getParam('id');

			$proxy = new SxCms_Event_DataMapper();
			$this->_event = $proxy->getEventById($event_id);
		}

		if($this->getRequest()->isPost()) {
			/* set the post */

			$this->_event->setSubscriptionAllow($this->_getParam('subscriptionAllow'))->setSubscriptionMax($this->_getParam('subscriptionMax'))->setNotifyEmail($this->_getParam('notifyEmail'))->setDateStart($this->_getParam('dateStart'))->setDateEnd($this->_getParam('dateEnd'))->setRememberDays($this->_getParam('rememberDays'))->setConfirmationLink($this->_getParam('confirmationLink'))->setValidateIntern($this->_getParam('validateIntern'));

			$timeEvent = $this->_getParam('datetimeH') . ':' . $this->_getParam('datetimeI') . ':00';
			$this->_event->setDateEvent($this->_getParam('dateEvent'))->setTimeEvent($timeEvent)->setLocation($this->_getParam('location'))->setTitle($this->_getParam('title'))->setDescription($this->_getParam('description'));

			$this->_event->setMailRemember($this->_getParam('mailRemember'))->setMailConfirmation($this->_getParam('mailConfirmation'));

			/* validate post */
			if($this->_event->isValid()) {
				$this->_event->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage($this->admin_tmx->_('eventedited'));

				$this->_helper->redirector->gotoSimple('index', 'event');
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Event');
		$this->view->event = $this->_event;
		$this->view->field = new SxCms_Event_Field();
		$this->view->list = new SxCms_Event_Field_List();
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('event', 'event.delete');

		$event_id = $this->_getParam('id');
		$proxy = new SxCms_Event_DataMapper();

		$this->_event = $proxy->getEventById($event_id);
		$this->_event->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('eventdeleted'));

		$this->_helper->redirector->gotoSimple('index', 'event');
	}
}