<?php

class Admin_AnalyticsController extends Zend_Controller_Action
{
	protected $logic;

    public function init() {
        $this->view->menu = array(
            'template' => 'analytics/__menu.phtml',
            'active'   => 'menu-analytics',
            'tab'      => 'analytics'
        );
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
		
		# Admin taal
		$systemAdmin = new Zend_Session_Namespace('SystemAdmin');
		$this->view->admin_tmx = $this->admin_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/analytics.tmx', $systemAdmin->lng);
		$this->view->admin_menu_tmx = $this->admin_menu_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/admin/menu.tmx', $systemAdmin->lng);
		
		$this->view->adminlngs = $adminlngs = $config->systemadmin->language;
    }
	
	/**
	 * Usage: $cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, func_get_args());
	 */
	protected function generateCacheId($cacheName, $params) {
		$str = ''; $i = 0;

		if(is_array($params) && count($params) != 0) {
			foreach($params as $param) {
				$i++;

				if($str == 1) {
					$str .= var_export($param, true);
				}
				else {
					$str .= '_'.var_export($param, true);
				}
			}
		}

		unset( $i ); $cacheName = $cacheName.'_'.sha1($str);

		if(trim(substr($cacheName, 50)) != '') {
			return substr($cacheName, 0, 50).'_'.sha1(substr($cacheName, 50));
		}

		return $cacheName;
	}
	
	public function profileAction() {
		
		$analytics = new SxCms_Analytics();
		if ($this->getRequest()->isPost()) {
			$profile = $this->_getParam('profile', '');
			if ($profile != '') {
				$analytics->setProfileid($profile)
					->save();
				header('Location: /admin/analytics');
				exit;
			}
		}
		require_once(APPLICATION_ROOT.'/library/Gapi/gapi.php');
		require_once(APPLICATION_ROOT.'/library/Gapi/gManagementApi.php');
		
		try {
			$ga = new gManagementApi($analytics->getLogin(), $analytics->getPass());
		} catch (exception $e) {
			$analytics->unsetAll()
				->save();
			header('Location: /admin/analytics');
			exit;
		}

		$accounts = $ga->requestAccountFeed();
		foreach ($accounts AS $result) {
			foreach ($result AS $property) {
				$profiles = $ga->requestAccountFeed($property["accountId"], '~all');
				foreach ($profiles AS $result) {
					foreach ($result AS $profile) {
						$accountProfiles[] = array("profileId" => $profile["profileId"], "profileName" => $profile["profileName"], "webPropertyId" => $profile["webPropertyId"]);
					}
				}
				$properties[] = array("accountId" => $property["accountId"], "accountName" => $property["accountName"], "accountProfiles" => $accountProfiles);
				unset($accountProfiles);
			}
		}
		$this->view->accounts = $properties;
		$this->view->step = $analytics->getStep();
		
	}

	public function loginAction() {
		$analytics = new SxCms_Analytics();

		if($this->getRequest()->isPost()) {
			$email = $this->_getParam('email', '');
			$password = $this->_getParam('password', '');
			//echo "email $email password $password";
			if ($email == '' OR $password == '') {
				$this->view->error = $this->admin_tmx->_('emailpasswordempty');
			} else {
				require_once(APPLICATION_ROOT.'/library/Gapi/gapi.php');
				require_once(APPLICATION_ROOT.'/library/Gapi/gManagementApi.php');
				try {
					$ga = new gManagementApi($email, $password);
				} catch (exception $e) {
					$this->view->error = $this->admin_tmx->_('logindoesntmatch');
				}
				if (!isset($e)) {
					$analytics->setLogin($email)
						->setPass($password)
						->setStep('2')
						->save();
					header('Location: /admin/analytics/profile');
					exit;
				}
			}
		}
	}

	protected function hasLoginInfo($noredirect = false) {
		
		$analytics = new SxCms_Analytics();
		if ($analytics->getLogin() === null) {
			if ($noredirect === false) {
				header('Location: /admin/analytics/login');
			} else {
				header('Location: /admin/analytics/iframe/logout/true');
			}
			exit;
		} else {
			if ($analytics->getProfileid() === null) {
				if ($noredirect === false) {
					header('Location: /admin/analytics/profile');
				} else {
					header('Location: /admin/analytics/iframe/logout/true');
				}
				exit;
			}
		}
	}
	
	public function initDates() {
			
		$analytics_dates = new Zend_Session_Namespace('SxCms_Analytics');
		$reformat = 1;
		if($this->getRequest()->isPost()) {
			if(strtotime($this->_getParam('fromDate')) && strtotime($this->_getParam('toDate'))) {
				if (strtotime($this->_getParam('fromDate')) > strtotime($this->_getParam('toDate'))) {
					$start = $analytics_dates->start_date = $this->_getParam('toDate');
				} else {
					$start = $analytics_dates->start_date = $this->_getParam('fromDate', date('Y-m-d', strtotime('-30 days')));
				}
				$end = $analytics_dates->end_date = $this->_getParam('toDate', date('Y-m-d'));
				$reformat = 0;
			}
		}
		if ($reformat === 1) {
			$start = date('Y-m-d', strtotime('-30 days'));
			$end = date('Y-m-d');
			if(isset($analytics_dates->start_date) && isset($analytics_dates->end_date)) {
				$start = $analytics_dates->start_date;
				$end = $analytics_dates->end_date;
			}
		}

		$this->view->startDate = $start;
		$this->view->endDate = $end;
	}
	
	public function gapiInitialize($noredirect = false) {
		$this->hasLoginInfo($noredirect);
		if ($this->_getParam('logout', 'false') == 'false') {
			
	        $analytics = new SxCms_Analytics();
			
			require_once(APPLICATION_ROOT.'/library/Gapi/gapi.php');
			require_once(APPLICATION_ROOT.'/library/Gapi/gManagementApi.php');
			require_once(APPLICATION_ROOT.'/library/Gapi/gapiLogic.php');
			$logic = $this->logic = new gapiLogic($analytics->getLogin(), $analytics->getPass(), $analytics->getProfileid());
	
			$logic->setDates($this->view->startDate, $this->view->endDate);
		
		}
	}

	/*protected function jsonOutput($data) {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');

		echo json_encode( $data );
	}*/

	public function indexAction() {
		/*if($this->_getParam('loading', 0) == 1) {*/
			$this->initDates();
			$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
				$this->view->startDate,
				$this->view->endDate
			));

			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache -> load($cacheId))) {
				$this->view->visits = $result['visits'];
				$this->view->totals = $result['totals'];
				$this->view->unique = $result['unique'];
				$this->view->pageviews = $result['pageviews'];
				$this->view->toppages = $result['toppages'];
				$this->view->topbrowsers = $result['topbrowsers'];
			}
			else {
				$this->gapiInitialize();
	
				$this->view->visits = $this->logic->getVisits();
				$this->view->totals = $this->logic->getTotals();
				$this->view->unique = $this->logic->getUnique();
				$this->view->pageviews = $this->logic->getAvgpageviews();
				$this->view->toppages = $this->logic->getToppages();
				$this->view->topbrowsers = $this->logic->getBrowsers();
				
				$data = array(
					'visits' => $this->view->visits,
					'totals' => $this->view->totals,
					'unique' => $this->view->unique,
					'pageviews' => $this->view->pageviews,
					'toppages' => $this->view->toppages,
					'topbrowsers' => $this->view->topbrowsers
				);
			
				$cacheTags = array(
					'Analytics_Index',
					'Analytics'
				);
	
				$cache->save($data, $cacheId, $cacheTags);
			}

			//$this->jsonOutput(array('html' => $this->view->render('analytics/index.phtml')));
		
		/*}
		else {
			$this->_helper->_layout->setLayout('loading');
			$this->_helper->viewRenderer->setNoRender(true);
		}*/
	}

	public function allpagesAction() {
		
		$this->initDates();
		
		$items = 30;
		$this->view->page = $page = ((int)$this->_getParam('page', 1)<1?1:(int)$this->_getParam('page', 1));
		$start = $page*$items;
		
		$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
			$start,
			$items,
			$this->view->startDate,
			$this->view->endDate
		));

		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache -> load($cacheId))) {
			$this->view->allpages = $result['allpages'];
		}
		else {
			$this->gapiInitialize();

			$this->view->allpages = $this->logic->getAllpages($start, $items);
			
			$data = array(
				'allpages' => $this->view->allpages
			);
		
			$cacheTags = array(
				'Analytics_Pages',
				'Analytics'
			);

			$cache->save($data, $cacheId, $cacheTags);
		}
	}

	public function allkeywordsAction() {
		
		$this->initDates();
		
		$items = 30;
		$this->view->page = $page = ((int)$this->_getParam('page', 1)<1?1:(int)$this->_getParam('page', 1));
		$start = $page*$items;
		
		$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
			$start,
			$items,
			$this->view->startDate,
			$this->view->endDate
		));

		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache -> load($cacheId))) {
			$this->view->allkeywords = $result['allkeywords'];
		}
		else {
			$this->gapiInitialize();

			$this->view->allkeywords = $this->logic->getAllkeywords($start, $items);
			
			$data = array(
				'allkeywords' => $this->view->allkeywords
			);
		
			$cacheTags = array(
				'Analytics_Keywords',
				'Analytics'
			);

			$cache->save($data, $cacheId, $cacheTags);
		}
	}

	public function mobileAction() {

		$this->initDates();
		$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
			$this->view->startDate,
			$this->view->endDate
		));

		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache -> load($cacheId))) {
			$this->view->mobile = $result['mobile'];
			$this->view->devices = $result['devices'];
		}
		else {
		$this->gapiInitialize();

			$this->view->mobile = $this->logic->getMobile();
			$this->view->devices = $this->logic->getDevices();
				
			$data = array(
				'mobile' => $this->view->mobile,
				'devices' => $this->view->devices
			);
		
			$cacheTags = array(
				'Analytics_Mobile',
				'Analytics'
			);

			$cache->save($data, $cacheId, $cacheTags);
		}
	}

	public function geoAction() {
		
		$this->initDates();
		$this->view->country = $this->_getParam('country');
		$this->view->iso = $this->_getParam('iso');

		$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
			$this->_getParam('country'),
			$this->_getParam('iso'),
			$this->view->startDate,
			$this->view->endDate
		));

		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache -> load($cacheId))) {
			$this->view->countries = $result['countries'];
			$this->view->cities = $result['cities'];
		}
		else {
			$this->gapiInitialize();
			
			if (!$this->view->country || !$this->view->iso) $this->view->countries = $this->logic->getCountries();
			else $this->view->cities = $this->logic->getCities($this->view->country);
				
			$data = array(
				'countries' => $this->view->countries,
				'cities' => $this->view->cities
			);
		
			$cacheTags = array(
				'Analytics_Geo',
				'Analytics'
			);

			$cache->save($data, $cacheId, $cacheTags);
		}
	}

	public function sourcesAction() {
		
		$this->initDates();

		$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
			$this->view->startDate,
			$this->view->endDate
		));
		
		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache -> load($cacheId))) {
			$this->view->keywords = $result['keywords'];
			$this->view->sources = $result['sources'];
			$this->view->medium = $result['medium'];
		}
		else {
			$this->gapiInitialize();
	
			$this->view->keywords = $this->logic->getTopkeywords(5);
			$this->view->sources = $this->logic->getTopsources(5);
			$this->view->medium = $this->logic->getMedium();
				
			$data = array(
				'keywords' => $this->view->keywords,
				'sources' => $this->view->sources,
				'medium' => $this->view->medium
			);
		
			$cacheTags = array(
				'Analytics_Sources',
				'Analytics'
			);

			$cache->save($data, $cacheId, $cacheTags);
		}
	}

	public function iframeAction() {

		$this->_helper->layout()->disableLayout();
		
		$this->view->iframeLogout = $this->_getParam('logout', 'false');
		
		if ($this->_getParam('logout', 'false') == 'false') {
			

			$cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, array(
				date('Y-m-d', strtotime('-7 days')),
				date('Y-m-d')
			));
			
			$cache = Zend_Registry::get('cache');
			if(true == ($result = $cache -> load($cacheId))) {
				$this->view->visitslastweek = $result['visitslastweek'];
				$this->view->pageslastweek = $result['pageslastweek'];
			}
			else {
				$this->gapiInitialize(true);
		
				$this->view->visitslastweek = $this->logic->getVisitsLastWeek();
				$this->view->pageslastweek = $this->logic->getPagesLastWeek();
					
				$data = array(
					'visitslastweek' => $this->view->visitslastweek,
					'pageslastweek' => $this->view->pageslastweek
				);
			
				$cacheTags = array(
					'Analytics_Iframe',
					'Analytics'
				);
	
				$cache->save($data, $cacheId, $cacheTags);
			}
		
		}
	}
	
	public function settingsAction() {
		
		$this->hasLoginInfo();
		
        $analytics = new SxCms_Analytics();
		if($this->getRequest()->isPost()) {
			if ($this->_getParam('deletelink') !== null) {
				$cache = Zend_Registry::get('cache');
				$cache->clean(
					Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG,
					array(
						'Analytics'
					)
				);
				$analytics->unsetAll()
					->save();
				header('Location: /admin/analytics');
				exit;
			}
		}
	}	

	public function deleteAllCache() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$cache = Zend_Registry::get('cache');
		$cache->clean(
			Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG,
			array(
				'Analytics'
			)
		);
	}
}