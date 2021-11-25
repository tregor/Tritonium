<?php

namespace Tritonium\Base;

use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\Log;
use Tritonium\Base\Services\Router;
use Tritonium\Base\Exceptions\BaseException;

class App extends BaseClass
{
	public static $components;
	public static $type;
	public static $config;

	/**
	 * @var $view View object
	 */
	public static $view;

	public static function init($config)
	{
		/**
		 * Settings from config.php
		 */
		App::$config = $config;
		// TODO: Rewrite Config class and system
		// foreach($config as $key => $val){
		//     Config::set($key, $val);
		// }

		if (App::debug()) {
		    ini_set('log_errors', TRUE);
		    ini_set('display_errors', TRUE);
		    ini_set('ignore_repeated_errors', TRUE);
		    ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
		    ini_set('error_log', DIR_ROOT . "log/errors.log");
		}
		
		App::$components = self::components($config['components']);
		App::$view = App::$components->view;
		session_start();
	}

	public static function start($type = 'web')
	{
		App::$type = $type;
		$request = App::$components->request;
		$router = App::$components->router;
		list($controller, $action) = ['default', 'index'];

		switch (App::$type) {
			case 'web':
				$args = Console::args();
				$route = $request->path();
				list($controller, $action) = explode("/", $route);
				break;
			case 'tmd':
				$args = Console::args();
				$route = Console::args(1);
				list($controller, $action) = explode("/", $route);
				break;
		}

		if ($router->hasRoute($route)) {
			return $router->route($route);
		}

		return $router->exec($controller, $action);
	}

	public static function debug()
	{
		return (App::$config['app']['debug'] === TRUE);
	}

	public static function loadClass($className)
	{
		$class = basename(str_replace(['\\', 'Tritonium'], ['/', ''], $className));
		$dir = strtolower(dirname(str_replace(['\\', 'Tritonium'], ['/', ''], $className)));
		$path = __DIR__ . '/..' . $dir . '/' . $class . '.php';

		if (is_file($path)) {
    		require_once $path;
    		return TRUE;
		}else{
			var_dump([
				'className' => $className,
				'class' => $class,
				'dir' => $dir,
				'path' => $path,
			]);
			throw new BaseException(App::class, "Can't load dynamic class {$className} on path {$path}");
		}
	}

	private static function components($components = [])
	{
		if (App::$components === NULL) {
			App::$components = new \StdClass();
		}

		foreach ($components as $alias => $component) {
			if (is_callable($component, true)) {
				$object = $component;
			}
			if (is_string($component)) {
				$className = $component;
				$object = new $className();
			}
			if (is_array($component)) {
				$className = $component['class'];
				$object = new $className($component['data']);
			}

			if (empty($object)) {
				throw new BaseException('InvalidConfigException', 'Unsupported component type: ' . gettype($component) . ', alias: ' . $alias);
			}

			App::$components->$alias = $object;
		}	

		return App::$components;
	}
}