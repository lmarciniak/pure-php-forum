<?php
require_once 'config.php';
require_once DIR_VENDOR . 'autoload.php';
require_once 'config-router.php';
session_start();
$router->run();
$file = $router->getFile();
$class = '\Forum\controllers\\' . $router->getClass();
$method = $router->getMethod();
require_once($file);
$controller = new $class();
$controller->$method();