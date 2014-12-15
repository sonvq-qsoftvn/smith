<?php
class MemberController extends Zend_Controller_Action
{

	public function init() {
		$config = Zend_Registry::get('config');
		$_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
		$this->view->lng = $_SESSION['System']['lng'];
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']);

	}

	public function logoutAction() {
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector->gotoSimple('index', 'index');
	}

	public function forgottenAction() {
		$proxy = new SxCms_Page_Proxy();
		$this->view->page = $proxy->getPageById('27', null, $this->_getParam('lng', 'en'));

		if($this->getRequest()->isPost()) {
			$email = $this->_getParam('email');
			$proxyUser = new SxModule_Members_Proxy();
			$user = $proxyUser->checkLogin($email);
			if($user) {
				$user = $proxyUser->getByEmail($email);
				$user->sendPassword();
				$this->view->message = 'You will receive an e-mail with your account data in a few moments.';
			}
			else {
				$this->view->error = 'This is not a valid e-mail address';
			}
		}
	}

	public function loginAction() {
		//get page content
		$proxy = new SxCms_Page_Proxy();
		$this->view->page = $proxy->getPageById('27', null, $this->_getParam('lng', 'en'));

		//create object
		$member = new SxModule_Members();
		$this->view->member = $member;
		$identity = Zend_Auth::getInstance()->getIdentity();

		if($this->getRequest()->isPost()) {
			//controleren of login bestaat
			$login = $this->_getParam('login');
			$password = $this->_getParam('password');
			$member = new SxModule_Members();
			$member->setEmail($login);
			$member->setPassword($password);
			if($member->checkLogin()) {
				$proxy = new SxModule_Members_Proxy();
				$member = $proxy->getByLogin($login, $password);

				$dbAdapter = Zend_Registry::get('db');
				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
				$authAdapter->setTableName('Member')->setIdentityColumn('id')->setCredentialColumn('password');

				$authAdapter->setIdentity($member->getId())->setCredential($member->getPassword());

				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if(!$result->isValid()) {
					return false;
				}

				$memb = $authAdapter->getResultRowObject(null, 'password');
				$storage = $auth->getStorage();
				if($memb->id == $member->getId()) {
					$storage->write($member);
				}
				else {
					$storage->write($user);
				}

				$identity = Zend_Auth::getInstance()->getIdentity();
				//forward
				$this->_forward('quick', 'index', null, array(
					'id' => '6',
					'lng' => $this->_getParam('lng', 'en')
				));
			}

			$this->view->member = $member;
		}

		$this->view->identity = $identity;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members');
	}

	public function _editablefields() {
		return array(
			'active', 'sex', 'name', 'first_name', 'company',
			'website', 'email', 'password', 'phone', 'fax',
			'street', 'number', 'mobile_phone', 'groups', 'postalcode',
			'place', 'country', 'board_members', 'groups'
		);
	}

	public function registerAction() {
		$proxy = new SxCms_Page_Proxy();
		$this->view->page = $proxy->getPageById('27', null, $this->_getParam('lng', 'en'));

		//enable groups if they can choose them
		/*
		 $proxy = new SxModule_Securedocs_Group_Proxy();
		 $groups = $proxy->getAll();
		 $this->view->groups = $groups;
		 */

		if($this->getRequest()->isGet()) {
			$item = new SxModule_Members();
		}

		if($this->getRequest()->isPost()) {
			$mapper = new SxModule_Members_Mapper();
			$fields = $mapper->fromInput($this->_getAllParams(), $this->_editablefields());
			$data = $mapper->toObject($fields);

			$validator = new SxModule_Members_Validator();
			if($validator->validate($data)) {
				$data->save();

				$cache = Zend_Registry::get('cache');
				$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG, array(
					'SxModule_Members'
				));

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Item werd succesvol aangemaakt!');

				$this->_helper->redirector->gotoSimple('login', 'member');
			}
			$item = $data;
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members');
		$this->view->item = $item;

	}

	public function profileAction() {
		$proxy = new SxCms_Page_Proxy();
		$this->view->page = $proxy->getPageById('29', null, $this->_getParam('lng', 'en'));

		//enable groups if they can choose them
		/*
		 $proxy = new SxModule_Securedocs_Group_Proxy();
		 $groups = $proxy->getAll();
		 $this->view->groups = $groups;
		 */
		$identity = Zend_Auth::getInstance()->getIdentity();
		$proxy = new SxModule_Members_Proxy();
		$item = $proxy->getById($identity->getId());

		if($this->getRequest()->isPost()) {
			$item->setActive($this->_getParam('active'));
			$item->setLng($_SESSION['System']['lng']);
			//$this->_getParam('language')
			$item->setSex($this->_getParam('sex'));
			$item->setName($this->_getParam('name'));
			$item->setFirstName($this->_getParam('firstname'));
			$item->setCompany($this->_getParam('company'));
			$item->setWebsite($this->_getParam('website'));
			$item->setEmail($this->_getParam('email'));
			$item->setPassword($this->_getParam('password'));
			$item->setPhone($this->_getParam('phone'));
			$item->setFax($this->_getParam('fax'));
			$item->setMobilePhone($this->_getParam('mobilephone'));
			$item->setStreet($this->_getParam('street'));
			$item->setNumber($this->_getParam('number'));
			$item->setPostalcode($this->_getParam('postalcode'));
			$item->setPlace($this->_getParam('place'));
			$item->setCountry($this->_getParam('country'));
			$item->setBoardMember($this->_getParam('boardmember'));
			$item->setGroups($this->_getParam('groups'));
			//groups = array;

			/* validate post */
			if($item->isValid()) {
				$item->save();
				$item->sendToAdmin();
				$this->view->success = "Aanpassingen succesvol opgeslagen";
			}
		}

		$this->view->messages = Sanmax_MessageStack::getInstance('SxModule_Members');
		$this->view->item = $item;

	}

}
?>