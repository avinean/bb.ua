<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('URI', explode('/', $_SERVER['REQUEST_URI'])[1]);

	require_once ROOT.'/../vendor/autoload.php';

	 $app = new \Klein\Klein();
	 require_once __DIR__ . '/../router/index.php';
	 $app->dispatch();

//$r =  require_once(ROOT.'/../config/config.php');
//print_r($r);