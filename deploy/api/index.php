<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

	use Slim\Factory\AppFactory;

	require __DIR__ . '/../vendor/autoload.php';
	
	$app = AppFactory::create();

	require_once __DIR__ . '/middleware.php';
	require_once __DIR__ . '/controller.php';
	require_once __DIR__ . '/route.php';

	// Run app
	$app->run();
