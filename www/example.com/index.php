<?php
require 'vendor/autoload.php';

$config = [
	'displayErrorDetails' => true,
	'determineRouteBeforeAppMiddleware' => true,
	'routerCacheFile' => false,
	'db' => [
		'host'   => '',
		'dbname' => ''
	]
];

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('views', ['cache' => false ]);

    // Instantiate and add Slim specific extension
    $view->addExtension( new Slim\Views\TwigExtension( $c['router'], $c['request']->getUri() ) );

    return $view;
};
$container['db'] = function ($c) {
	$db = $c['settings']['db'];
	try {
		$connection_string = "sqlsrv:Server={$db['host']};Database={$db['dbname']};ConnectionPooling=0";
		$pdo = new PDO($connection_string);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	} catch (PDOException $e) {
		// throw $e;
		// log(maybe there is no database :( ));
	}
};

$container['HomeCtrl'] = function () use ($container) {
	return new \Lib\Controllers\HomeCtrl($container);
};

require_once 'routes.php';
$app->run();