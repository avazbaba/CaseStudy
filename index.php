<?php
require_once __DIR__ . '/bootstrap.php';

$requestPath = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$pathParts = explode('/', trim($requestPath, '/'));

$controllerName = !empty($pathParts[0]) ? $pathParts[0] : 'base';
$actionName = !empty($pathParts[1]) ? $pathParts[1] : 'index';
$params = array_slice($pathParts, 2);

$controllerClassName = "App\\Controller\\" . ucfirst($controllerName) . "Controller";

try {
    if (!class_exists($controllerClassName)) {
        throw new Exception("Controller not found.", 404);
    }

    $controller = new $controllerClassName();

    if (!method_exists($controller, $actionName) || !is_callable([$controller, $actionName])) {
        throw new Exception("Method not found.", 404);
    }

    call_user_func_array([$controller, $actionName], $params);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo $e->getMessage() === "404" ? "404 Not Found" : "An error occurred";
}
