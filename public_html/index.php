<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../application/init.php';

$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new SxCms_Controller_Plugin_Bootstrap(APPLICATION_ENV))
    ->throwExceptions( (APPLICATION_ENV == 'production') ? false : true )
    ->dispatch();