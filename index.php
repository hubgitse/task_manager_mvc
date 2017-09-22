<?php

include __DIR__.'/app/bootstrap.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

/** @var \app\Lib\Router $router */
$router = \app\Lib\Registry::get('router');
// Object Controller -> [controllerClass, action].
list($controllerClass, $action, $arguments) = $router->getController($requestUri, $requestMethod);

$controller = new $controllerClass;
echo call_user_func_array(
    [$controller, $action],
    $arguments
);