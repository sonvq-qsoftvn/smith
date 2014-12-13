<?php

set_time_limit(0);

if(file_exists(dirname(__FILE__) . '/../public_html/env.php'))
	include(dirname(__FILE__) . '/../public_html/env.php');

// Define path to application directory
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));

// Define application environment
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', 'development');
}

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
	realpath(APPLICATION_PATH . '/../public_html/js/tiny_mce'),
    get_include_path(),
)));

date_default_timezone_set('Europe/Brussels');

//Init lazy loading
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Sanmax_')
	->registerNamespace('SxCms_')
	->setFallbackAutoloader(true);
