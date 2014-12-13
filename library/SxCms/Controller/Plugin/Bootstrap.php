<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Bootstrap.php 9962 2010-12-02 11:01:34Z mindy $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Controller_Plugin_Bootstrap
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Controller_Plugin_Bootstrap extends Zend_Controller_Plugin_Abstract {
    /**
     * @var Zend_Config
     */
    protected $_config;

    /**
     * @var string Current environment
     */
    protected $_env;

    /**
     * @var Zend_Controller_Front
     */
    protected $_front;

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        $this->initSession();
        $this->initLocales();
    }

    /**
     * Route startup
     *
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        $this->initDb();
        $this->initFrontController();
        $this->initView();
        $this->initRoutes();
        $this->initHelpers();
        $this->initCache();
		$this->initFirebug();
    }

    /**
     * Constructor
     *
     * Initialize environment, root path, and configuration.
     *
     * @param  string $env
     * @param  string|null $root
     * @return void
     */
    public function __construct($env) {
        $this->_env = $env;
        $this->initConfig();
        $this->initPhpConfig();

        $this->_front = Zend_Controller_Front::getInstance();
    }

    public function initConfig() {
        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', $this->_env);
        Zend_Registry::set('config', $this->_config);
    }

    public function initPhpConfig() {
        date_default_timezone_set($this->_config->locale->timezone);
        setlocale(LC_ALL, $this->_config->locale->code);
    }

    public function initSession() {
        $request = $this->getRequest();
        Zend_Session::start();

        $system = new Zend_Session_Namespace('System');
        if ($request && $request->getParam('lng')) {
            $system->lng = $request->getParam('lng');
            SxCms_Global::$language = $system->lng;
        }
    }

    public function initDb() {
        $dbCfg = $this->_config->db;
        $dbApp = Zend_Db::factory($dbCfg->adapter, $dbCfg->params->toArray());

        Zend_Db_Table_Abstract::setDefaultAdapter($dbApp);
        Zend_Registry::set('db', $dbApp);
    }

    public function initFrontController() {
        $this->_front->addModuleDirectory(APPLICATION_PATH . '/modules')
	        ->registerPlugin(new SxCms_Controller_Plugin_HTTPCrawler())
	        ->registerPlugin(new SxCms_Controller_Plugin_Auth())
	        ->registerPlugin(new SxCms_Controller_Plugin_Messenger())
	        ->registerPlugin(new SxCms_Controller_Plugin_PageLocker())
	        ->registerPlugin(new SxCms_Controller_Plugin_ErrorSelector());
    }

    public function initLocales() {
        $config   = Zend_Registry::get('config');
        $request  = $this->getRequest();
        $language = $request->getParam('lng');

        $locales = $config->locale->list->toArray();
        if (!isset($locales[$language])) {
            $language = $config->locale->default;
        }

		if(isset($_SESSION["SystemAdmin"]["lng"]) && $_SESSION["SystemAdmin"]["lng"] != ""){
			$language = $_SESSION["SystemAdmin"]["lng"];
 		}
		elseif(!isset($_SESSION["SystemAdmin"]["lng"])) {
			$_SESSION["SystemAdmin"]["lng"] = $config->locale->default;
		}

        $translator = new Zend_Translate('array', APPLICATION_ROOT . '/application/resources/languages', $language, array(
				'scan' => Zend_Translate::LOCALE_DIRECTORY
			)
        );

        Zend_Validate_Abstract::setDefaultTranslator($translator);
        $locale = new Zend_Locale($locales[$language]);

        setlocale(LC_ALL, $locales[$language]);
    }

    public function initRoutes() {
        $config = Zend_Registry::get('config');
        $this->_front->setBaseUrl($config->system->web->baseurl);

        $nl = array(
            'content'  => 'inhoud',
            'detail'   => 'detail',
            'news'     => 'nieuws',
            'event'    => 'event',
            'calendar' => 'kalender',
            'vacancy'  => 'vacatures',
            'webtv'    => 'webtv',
            'login'    => 'login',
            'profile'  => 'edit-profile',
        );

        $fr = array(
	        'content'  => 'contenu',
	        'detail'   => 'detail',
	        'news'     => 'actualite',
	        'event'    => 'evenement',
	        'calendar' => 'calendrier',
	        'vacancy'  => 'vacances',
	        'webtv'    => 'webtv',
	        'login'    => 'login',
	        'profile'  => 'edit-profile',
        );
        
        $en = array(
	        'content'  => 'content',
	        'detail'   => 'detail',
	        'news'     => 'news',
	        'event'    => 'event',
	        'calendar' => 'calendar',
	        'vacancy'  => 'vacancy',
	        'webtv'    => 'webtv',
	        'login'    => 'login',
	        'profile'  => 'profile',
        );

        $translator = new Zend_Translate('array', $en, 'en');
        //$translator->addTranslation($fr, 'fr');
        //$translator->addTranslation($en, 'en');

        $request  = $this->getRequest();
        $languageTranslator = substr($request->getRequestUri(),1,2);

        $locales = $config->locale->list->toArray();
        if (!isset($locales[$languageTranslator])) {
            $languageTranslator = $config->locale->default;
        }

        $translator->setLocale($languageTranslator);
        Zend_Controller_Router_Route::setDefaultTranslator($translator);

        $router = $this->_front->getRouter();
        $localeRoute = new Zend_Controller_Router_Route(
                ':lng', array(
                    'controller' => 'index',
                    'action'     => 'content',
                    'module'     => 'default',
                    'lng'        => 'en',
                ),
                array('lng' => '(en)')
        );

        $router->addRoute('locale', $localeRoute);


        $contentRoute = new Zend_Controller_Router_Route_Regex(
                '(.+)', array(
                    'controller' => 'index',
                    'action'     => 'content',
                    'url'        => null,
                ),
                array(1 => 'url'),
                '%s'
        );

        $router->addRoute('content', $localeRoute->chain($contentRoute, '/'));


        $newsRoute = new Zend_Controller_Router_Route(
            '@news/*', array(
                'controller' => 'news',
                'action'  => 'archive',
            ),
            '%s'
        );

        $newsChainedRoute = $localeRoute->chain($newsRoute, '/');
        $router->addRoute('news-archive', $newsChainedRoute);


		$newsdetailRoute = new Zend_Controller_Router_Route(
            '@news/:id/:title', array(
                'controller' => 'news',
                'action' => 'newsdetail'
            )
        );


        $newsdetailChainedRoute = $localeRoute->chain($newsdetailRoute, '/');
        $router->addRoute('news-article', $newsdetailChainedRoute);


		$newsRoute = new Zend_Controller_Router_Route(
            '@news/page/:page', array(
                'controller' => 'news',
                'action' => 'archive',
                'page' => 1
            )
        );

        $newsChainedRoute = $localeRoute->chain($newsRoute, '/');
        $router->addRoute('news-archive2', $newsChainedRoute);


        $articleRoute = new Zend_Controller_Router_Route_Regex(
                '(.+)', array(
                    'controller' => 'index',
                    'action'     => 'content',
                    'url'		 => null,
                ),
                array(1 => 'url'),
                '%s'
        );

        $articleChainedRoute = $localeRoute->chain($newsRoute, '/')
                ->chain($articleRoute);

        $router->addRoute('news-article', $articleChainedRoute);


        $fmRoute = new Zend_Controller_Router_Route_Regex(
                'doc/?(.*)', array(
                        'controller' => 'filemanager',
                        'action'     => 'index',
                        'folder'     => null,
                ),
                array(1 => 'folder'),
                'doc/%s'
        );

        $router->addRoute('filemanager', $localeRoute->chain($fmRoute, '/'));


        $contactRoute = new Zend_Controller_Router_Route(
                'contact', array(
                        'controller' => 'contact',
                        'action'     => 'form',
                ),
                '%s'
        );

        $contactChainedRoute = $localeRoute->chain($contactRoute, '/');
        $router->addRoute('contact', $contactChainedRoute);


        $contactSentRoute = new Zend_Controller_Router_Route_Regex(
                'verzonden', array(
                        'controller' => 'contact',
                        'action'     => 'sent',
                ),
                '%s'
        );

        $contactSentChainedRoute = $localeRoute->chain($contactRoute, '/')->chain($contactSentRoute, '/');
        $router->addRoute('contact-sent', $contactSentChainedRoute);


        $publicationRoute = new Zend_Controller_Router_Route(
            '@publications/:category/:page', array(
                'controller' => 'publication',
                'action'     => 'index',
                'category'   => 0,
                'page'       => 1
            )
        );

        $publicationChainedRoute = $localeRoute->chain($publicationRoute, '/');
        $router->addRoute('publications', $publicationChainedRoute);

        $publicationDetailRoute = new Zend_Controller_Router_Route(
            '@publications/@detail/:id', array(
                'controller' => 'publication',
                'action'     => 'details',
            ),
            array('id' => '\d+')
        );

        $publicationDetailChainedRoute = $localeRoute->chain($publicationDetailRoute, '/');
        $router->addRoute('publication-detail', $publicationDetailChainedRoute);


        $eventCalendarRoute = new Zend_Controller_Router_Route(
            '@event/@calendar/:page', array(
                'controller' => 'event',
                'action'     => 'calendar',
                'page'       => 1,
            )
        );

        $eventCalendarChainedRoute = $localeRoute->chain($eventCalendarRoute, '/');
        $router->addRoute('event-calendar', $eventCalendarChainedRoute);


        $eventRoute = new Zend_Controller_Router_Route(
            '@event/:id', array(
                'controller' => 'event',
                'action'     => 'index',
            ),
            array('id' => '\d+')
        );

        $eventChainedRoute = $localeRoute->chain($eventRoute, '/');
        $router->addRoute('event', $eventChainedRoute);


        $vacancyRoute = new Zend_Controller_Router_Route(
            '@service/@vacancy/:category/:page', array(
                'controller' => 'vacancy',
                'action'     => 'index',
                'category'   => 0,
                'page'       => 1,
            )
        );

        $vacancyChainedRoute = $localeRoute->chain($vacancyRoute, '/');
        $router->addRoute('vacancy', $vacancyChainedRoute);


        $vacancyRoute = new Zend_Controller_Router_Route(
            'service-et-information/vacances/:category/:page', array(
                'controller' => 'vacancy',
                'action'     => 'index',
                'category'   => 0,
                'page'       => 1,
            )
        );

        $vacancyChainedRoute = $localeRoute->chain($vacancyRoute, '/');
        $router->addRoute('vacancyfr', $vacancyChainedRoute);

        $vacancyDetailRoute = new Zend_Controller_Router_Route(
            '@vacancy/@detail/:id', array(
                'controller' => 'vacancy',
                'action'     => 'details',
            ),
            array('id' => '\d+')
        );

        $vacancyDetailChainedRoute = $localeRoute->chain($vacancyDetailRoute, '/');
        $router->addRoute('vacancy-detail', $vacancyDetailChainedRoute);


        $webtvOverviewRoute = new Zend_Controller_Router_Route(
            '@webtv/*', array(
                'controller' => 'webtv',
                'action'     => 'overview',
            )
        );

        $webtvOverviewChainedRoute = $localeRoute->chain($webtvOverviewRoute, '/');
        $router->addRoute('webtv-overview', $webtvOverviewChainedRoute);


        $webtvDetailRoute = new Zend_Controller_Router_Route(
            '@webtv/view/:url/:id', array(
                'controller' => 'webtv',
                'action'     => 'detail',
            )
        );

        $webtvDetailChainedRoute = $localeRoute->chain($webtvDetailRoute, '/');
        $router->addRoute('webtv-detail', $webtvDetailChainedRoute);


        $registerRoute = new Zend_Controller_Router_Route(
            'registreer', array(
                'controller' => 'member',
                'action'     => 'register',
            )
        );

        $registerChainedRoute = $localeRoute->chain($registerRoute, '/');
        $router->addRoute('register', $registerChainedRoute);


        $profileRoute = new Zend_Controller_Router_Route(
            '@profile', array(
                'controller' => 'member',
                'action'     => 'profile',
            )
        );

        $profileChainedRoute = $localeRoute->chain($profileRoute, '/');
        $router->addRoute('profile', $profileChainedRoute);


        $loginRoute = new Zend_Controller_Router_Route(
            '@login', array(
                'controller' => 'member',
                'action'     => 'login',
            )
        );

        $loginChainedRoute = $localeRoute->chain($loginRoute, '/');
        $router->addRoute('login', $loginChainedRoute);


        $logoutRoute = new Zend_Controller_Router_Route(
            'logout',
            array(
                'controller' => 'member',
                'action'     => 'logout',
            )
        );

        $logoutChainedRoute = $localeRoute->chain($logoutRoute, '/');
        $router->addRoute('logout', $logoutChainedRoute);


        $forgotRoute = new Zend_Controller_Router_Route(
            'forgot', array(
                'controller' => 'member',
                'action'     => 'forgotten',
            )
        );

        $forgotChainedRoute = $localeRoute->chain($forgotRoute, '/');
        $router->addRoute('forgotten', $forgotChainedRoute);


        $securedocsRoute = new Zend_Controller_Router_Route(
            '@securedocs/*', array(
                'controller' => 'securedocs',
                'action'     => 'index',
            )
        );

        $securedocsChainedRoute = $localeRoute->chain($securedocsRoute, '/');
        $router->addRoute('securedocs', $securedocsChainedRoute);


        $loginRoute = new Zend_Controller_Router_Route(
            '/auth/:action/:url', array(
                'controller' => 'auth',
                'action'     => 'login',
                'url'        => '',
            )
        );

        $loginChainedRoute = $localeRoute->chain($loginRoute, '/');
        $router->addRoute('login-auth', $loginChainedRoute);


        $router->addRoute(
            'admin', new Zend_Controller_Router_Route('admin/:controller/:action/*', array(
                'controller' => 'index',
                'action'     => 'index',
                'module'     => 'admin'
            )
        ));


        $shopCartRoute = new Zend_Controller_Router_Route(
            'shop/cart', array(
                'controller' => 'shop',
                'action'     => 'cart',
            )
        );

        $shopCartChainedRoute = $localeRoute->chain($shopCartRoute, '/');
        $router->addRoute('shop-cart', $shopCartChainedRoute);


        $search = new Zend_Controller_Router_Route(
                'search/*',
                array(
                        'controller' => 'search',
                        'action'     => 'index',
                )
        );
        $searchChainedRoute = $localeRoute->chain($search, '/');
        $router->addRoute('search', $searchChainedRoute);


        $searchadv = new Zend_Controller_Router_Route(
            'search/advanced/*', array(
                'controller' => 'search',
                'action'     => 'advanced',
            )
        );
        $searchadvChainedRoute = $localeRoute->chain($searchadv, '/');
        $router->addRoute('search-advanced', $searchadvChainedRoute);


        $router->addRoute(
            'file-download', new Zend_Controller_Router_Route_Regex('files/(.*)', array(
                'controller' => 'file',
                'action'     => 'download',
            ),
            array(1 => 'filename'),
            'files%s'
        ));
    }

    public function initHelpers() {
        Zend_Controller_Action_HelperBroker::addPrefix('SxCms_Controller_Action_Helper');
    }

    public function initview() {
        $config = Zend_Registry::get('config');
        Zend_Layout::startMvc(array('layout' => 'default'));

        $mvc  = Zend_Layout::getMvcInstance();
        $mvc->getView()
                ->addHelperPath(APPLICATION_ROOT . '/library/SxCms/View/Helper', 'SxCms_View_Helper')
                ->setEncoding('UTF-8');
    }

    public function initCache() {
        $frontendOptions = array(
                'lifetime' => 7200, // cache lifetime of 2 hours
                'automatic_serialization' => true,
        );

        $backendOptions = array(
                'cache_dir' => APPLICATION_ROOT . '/tmp/cache/var'
        );

        $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        Zend_Registry::set('cache', $cache);
    }

	public function initFirebug() {
		$writer = new Zend_Log_Writer_Firebug();
		
		if(APPLICATION_ENV == 'production') {
			$writer->setEnabled( ($this->_config->system->debug->firebug && $this->_config->system->debug->ip == $this->getRequest()->getClientIp() ) ? true : false );
		}
		else {
			$writer->setEnabled( ($this->_config->system->debug->firebug) ? true : false );
		}

		$logger = new Zend_Log($writer);
		Zend_Registry::set('logger', $logger);
	}
}
