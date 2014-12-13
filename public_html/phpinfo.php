<?php

if(file_exists(dirname(__FILE__) . '/../public_html/env.php')) {
	include(dirname(__FILE__) . '/../public_html/env.php');
}

if(!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', 'development');
}

if(APPLICATION_ENV == 'development') {
	echo phpinfo();
}
else {
	die('Nope..');
}
