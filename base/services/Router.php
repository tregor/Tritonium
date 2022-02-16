<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\Controllers\BaseController;

class Router extends BaseService
{
	public $routes = [];
	private $args;
	private $path;
	private $controllerName;
	private $controllerAction;
	private $controllerObj;

	public function addRoute($route = '', $function)
	{
		self::$routes[$route] = $function;
	}

	public function getRoute($route)
	{
		return self::$routes[$route];
	}

	public function hasRoute($path)
	{
		foreach ($this->routes as $route => $action) {
			$regex = [];
			$original = str_replace('/', '\/', $route);
			preg_match_all('/^.*<(?:(.*):)?(.*)>.*$/m', $route, $matches, PREG_SET_ORDER, 0);

			foreach ($matches as $match) {
				array_shift($match);
				$match = array_filter($match);
				if (count($match) == 1) {
					$regex[$match[1]] = '.*';
				}elseif (count($match) == 2) {
					$regex[$match[0]] = $match[1];
				}

				foreach ($regex as $key => $mask) {
					$original = preg_replace('/<(.*)>/m', '(' . $mask . ')', $original, 1);
				}
			}

			if (preg_match('/^' . $original . '$/m', $path, $args)) {
				array_shift($args);
				$args = array_combine(array_keys($regex), $args);

				return TRUE;
			}
		}

		return FALSE;
	}

	public function route($path)
	{
		foreach ($this->routes as $route => $action) {
			$original = str_replace('/', '\/', $route);
			preg_match_all('/^.*<(?:(.*):)?(.*)>.*$/m', $route, $matches, PREG_SET_ORDER, 0);

			foreach ($matches as $match) {
				array_shift($match);
				$match = array_filter($match);
				if (count($match) == 1) {
					$regex[$match[1]] = '.*';
				}elseif (count($match) == 2) {
					$regex[$match[0]] = $match[1];
				}

				foreach ($regex as $key => $mask) {
					$original = preg_replace('/<(.*)>/Um', '(' . $mask . ')', $original, 1);
				}
			}

			if (preg_match('/^' . $original . '$/m', $path, $args)) {
				array_shift($args);
				$args = @array_combine(array_keys($regex), $args);
	
				// var_dump([$path, $original, $action, $args]);die();
				if (gettype($action) == 'string') {
					list($controller, $action) = explode("@", str_replace('Controller', '' , $action));
					return $this->exec($controller, $action, $args);
				}elseif (gettype($action) == 'object'){

				}else{
					var_dump([$action, gettype($action)]); die();
				}
			}
		}

		return FALSE;
	}

	public function exec($controller = 'default', $action = 'index', $args = [])
	{
		$this->args = $args;
		$this->controllerName = toCamelCase($controller);
		$this->controllerAction = toCamelCase($action);
		$controllerAppName = "Tritonium\\App\\Controllers\\".$this->controllerName."Controller";
		$controllerBaseName = "Tritonium\\Base\\Controllers\\".$this->controllerName."Controller";

		if (class_exists($controllerAppName)) {
		    $this->controllerObj = new $controllerAppName;
		} elseif (class_exists($controllerBaseName)) {
		    $this->controllerObj = new $controllerBaseName;
		} else{
		    throw new \Exception('Controller "' . $this->controllerName . 'Controller" not found');
		}

		if ($this->controllerObj instanceof BaseController) {
		    $response = $this->controllerObj->action($this->controllerAction, $this->args);

		    return $response;
		}
	}
}