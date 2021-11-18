<?php
/**
 * index.php file recently used to be starting point of scipt
 * Better usage is to use index.php as a router file for project
 */
require_once __DIR__ . '/../base/bootstrap.php';

$route = $_SERVER['REQUEST_URI'];
// var_dump($route);

$route = preg_replace('/\?.*/', '', $route);
// var_dump($route);


// TODO: Routing by app service
// var_dump(explode("/", $route));
list($null, $controller, $action) = explode("/", $route);
$controllerName = toCamelCase($controller) ?: "Default";
$controllerAction = toCamelCase($action) ?: "Index";
$controllerFile = DIR_CONTROLLERS . $controllerName . "Controller.php";
$controllerName = "Tritonium\\App\\Controllers\\".$controllerName."Controller";


/** 
 * Debug notes
 * Routing must be based like Controller/Action
 * Controller is Controller name. Default is actions for DefaultController
 * Action is method name inside Controller
 */
// var_dump([
//     'controller' => $controller,
//     'action' => $action,
//     'controllerName' => $controllerName,
//     'controllerAction' => $controllerAction,
//     'controllerFile' => $controllerFile,
// ]);
// die();

if (!file_exists($controllerFile)) {
    //TODO: Raise Exception
    die("Controller file not found");
}else{
    require_once $controllerFile;
}

$controllerClass = new $controllerName();
$controllerClass->execute($controllerAction);