<?php

class EventController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
		
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $this->_getParam('lng','nl')); 
	}

    public function nextAction()
    {
        $proxy = new SxCms_Event_DataMapper();
        $this->view->events = $proxy->getNextEvents();
    }

    public function indexAction()
    {
        $this->_helper->layout->setLayout('full');
		
		$event_id = $this->_getParam('id');
		
		if ($this->getRequest()->isGet()) {
			$proxy = new SxCms_Event_DataMapper();
			$event = $proxy->getEventById($event_id);
		}
		
		if ($this->getRequest()->isPost()) {
			$proxy = new SxCms_Event_DataMapper();
			$event = $proxy->getEventById($event_id);
			$subscription = array();
			$errors = array();
			foreach($event->getFields() as $field) {
				if (!$this->_getParam($field->getName()))
					$errors[$field->getName()] = $field->getLabel();
				$subscription[$field->getName()] = $this->_getParam($field->getName());	
			}
			
			if(sizeof($errors) == 0) {
				$Subscription = new SxCms_Event_Subscription();
				$Subscription->setEventId($event_id);
				if ($event->isValidateIntern()) {
					$Subscription->setStatus(0);
					$sub_id = $Subscription->save();
					
				} else {
					$Subscription->setStatus(1);
					$sub_id = $Subscription->save();
					$Subscription->sendConfirmation();
				}
				
				foreach($event->getFields() as $field) {
					if($field->getType() == 'checkbox')
						$value = implode(';',$this->_getParam($field->getName()));
					else
						$value =  $this->_getParam($field->getName());
						
					$SubF = new SxCms_Event_Subscription_Field();
					$SubF->setSubscriptionId($sub_id)
						->setFieldId($field->getId())
						->setName($field->getName())
						->setValue($value);
					$SubF->save();
				}
				
  				$this->view->result = true;
			} else {
				$this->view->errors = $errors;	
			}
		
			$this->view->subscription = $subscription;
			
		}	
		
		$mapperSub = new SxCms_Event_Subscription_DataMapper();
        $subscriptions = $mapperSub->getSubscriptionsForEvent($event_id);

        $now = strtotime(date('Y-m-d'));
        if(count($subscriptions) >= $event->getSubscriptionMax() || strtotime($event->getDateEnd()) < $now  || strtotime($event->getDateStart()) > $now  ) {
            $event->setSubscriptionAllow(false);
        }

		$this->view->subscriptions = $subscriptions;
        $this->view->event = $event;
        $this->getResponse()
            ->setHeader('Last-Modified', $event->getDateStart("%a, %d %b %Y %H:%I%S GMT"));
    }

    public function calendarAction()
    {
        $this->_helper->layout->setLayout('full');

        $proxy  = new SxCms_Event_DataMapper();
        $events = $proxy->getNextEvents(null);
        $config = Zend_Registry::get('config');

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($events));
        $paginator->setCurrentPageNumber($this->_getParam('page'))
            ->setItemCountPerPage($config->modules->event->list->count);

        $this->view->paginator = $paginator;
    }
}
