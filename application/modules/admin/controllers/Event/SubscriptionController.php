<?php
class Admin_Event_SubscriptionController extends Zend_Controller_Action
{
	protected $_event;

	public function init() {
		$config = Zend_Registry::get('config');
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

	public function listAction() {
		SxCms_Acl::requireAcl('subscriptions', 'subscription.list');

		$event_id = $this->_getParam('id');
		$proxy = new SxCms_Event_DataMapper();
		$this->_event = $proxy->getEventById($event_id);

		if(!$this->_event) {
			$this->_helper->redirector->gotoSimple('index', 'event', null, array());
		}

		$subProxy = new SxCms_Event_Subscription_DataMapper();
		$subscriptions = $subProxy->getSubscriptionsForEvent($this->_getParam('id'));

		$fieldProxy = new SxCms_Event_Field_DataMapper();
		$fields = $fieldProxy->getFieldsByEvent($this->_getParam('id'));

		$this->view->event = $this->_event;
		$this->view->subscriptions = $subscriptions;
		$this->view->fields = $fields;

	}

	public function updateAction() {
		//SxCms_Acl::requireAcl('subscriptions', 'subscription.update');

		$subscription_id = $this->_getParam('id');

		$proxy = new SxCms_Event_Subscription_DataMapper();
		$subscription = $proxy->getSubscriptionById($subscription_id);

		$proxyEvents = new SxCms_Event_DataMapper();
		$event = $proxyEvents->getEventById($subscription->getEventId());

		if($this->getRequest()->isPost()) {
			if(($subscription->getStatus() != $this->_getParam('status')) && ($this->_getParam('status') == 1))
				$subscription->sendConfirmation();

			$subscription->setStatus($this->_getParam('status'));
			$subscription->save();

			foreach($event->getFields() as $field) {
				if($field->getType() == 'checkbox')
					$value = implode(';', $this->_getParam($field->getName()));
				else
					$value = $this->_getParam($field->getName());

				$SubF = new SxCms_Event_Subscription_Field();
				$SubF->setSubscriptionId($subscription_id)->setFieldId($field->getId())->setName($field->getName())->setValue($value);

				$mapperSubField = new SxCms_Event_Subscription_Field_DataMapper();
				if($mapperSubField->checkIfExists($SubF)) {
					$SubF->update();
				}
				else {
					$SubF->save();
				}
			}
			$this->_helper->redirector->gotoSimple('list', 'event_subscription', null, array('id' => $event->getId()));
		}

		$this->view->subscription = $subscription;
		$this->view->event = $event;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Event_Subscription');
	}

	public function deleteAction() {
		SxCms_Acl::requireAcl('subscriptions', 'subscription.delete');

		$subscription_id = $this->_getParam('id');

		$proxy = new SxCms_Event_Subscription_DataMapper();
		$subscription = $proxy->getSubscriptionById($subscription_id);

		$Subscription = new SxCms_Event_Subscription();
		$Subscription->setSubscriptionId($subscription_id);
		$Subscription->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage($this->admin_tmx->_('subscriptiondeleted'));

		$this->_helper->redirector->gotoSimple('list', 'event_subscription', null, array('id' => $subscription->getEventId()));
	}

	public function exportAction() {
		SxCms_Acl::requireAcl('subscriptions', 'subscription.export');

		$event_id = $this->_getParam('id');
		$eventMapper = new SxCms_Event_DataMapper();
		$event = $eventMapper->getEventById($event_id);

		$subProxy = new SxCms_Event_Subscription_DataMapper();
		$subscriptions = $subProxy->getValidSubscriptionsForEvent($event_id);

		$fieldProxy = new SxCms_Event_Field_DataMapper();
		$fields = $fieldProxy->getFieldsByEvent($event_id);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->createSheet("Event Subsciptions");
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPSheet = $objPHPExcel->getActiveSheet();

		$objPHPSheet->setCellValueByColumnAndRow(0, 1, $this->admin_tmx->_('subscriptionsforevent') . $event->getTitle());

		$i = 0;
		foreach($fields as $field) {
			$objPHPSheet->setCellValueByColumnAndRow($i, 2, $field->getLabel());
			$i++;
		}

		$j = 3;
		foreach($subscriptions as $subscription) {
			$i = 0;
			foreach($fields as $field) {
				$objPHPSheet->setCellValueByColumnAndRow($i, $j, $subscription[$field->getName()]);
				$i++;
			}
			$j++;
		}

		$file = "sub_" . date("d_m_Y") . ".xls";
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment; filename={$file}");
		header("Content-Transfer-Encoding: binary");
		error_reporting(0);
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		$objWriter->setTempDir(APPLICATION_ROOT . '/tmp');
		$objWriter->save("php://output");

		die();
	}
}