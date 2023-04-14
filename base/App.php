<?php

namespace Tritonium\Base;

use StdClass;
use Tritonium\Base\Exceptions\BaseException;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\View;


class App extends BaseClass
{
    public static $components;
    public static $type;
    public static $config;
    /**
     * @var $view View object
     */
    public static View $view;

    public static function init($config)
    {
        /* Settings from config.php */
        App::$config = json_decode(json_encode($config), false);

        ini_set('log_errors', true);
        ini_set('error_log', DIR_ROOT . "errors.log");
        ini_set('ignore_repeated_errors', true);

        if (App::debug()) {
            ini_set('display_errors', true);
            ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        } else {
            ini_set('display_errors', false);
            ini_set('error_reporting', E_ALL);
        }

        App::$components = self::components($config['components']);
    }

    public static function debug()
    {
        return (App::$config->app->debug === true);
    }

    private static function components($components = [])
    {
        if (App::$components === null) {
            App::$components = new StdClass();
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
                throw new BaseException(
                    'InvalidConfigException',
                    'Unsupported component type: ' . gettype($component) . ', alias: ' . $alias
                );
            }

            App::$components->$alias = $object;
        }

        return App::$components;
    }

    public static function loadClass($className)
    {
        $class = basename(str_replace(['\\', 'Tritonium'], ['/', ''], $className));
        $dir = strtolower(dirname(str_replace(['\\', 'Tritonium'], ['/', ''], $className)));
        $path = __DIR__ . '/..' . $dir . '/' . $class . '.php';

        if (is_file($path)) {
            require_once($path);

            return true;
        } else {
            return false;
        }
    }

    public static function start($type = 'web')
    {
        App::$type = $type;
        $request = App::$components->request;
        $router = App::$components->router;
        $route = 'default/index';

        switch (App::$type) {
            case 'web':
                $route = $request->path();
                break;
            case 'tmd':
                $route = Console::args(1);
                break;
        }
        @list($controller, $action) = explode("/", $route);

        if (empty($controller)) {
            $controller = 'default';
        }
        if (empty($action)) {
            $action = 'index';
        }

        if ($router->hasRoute($route)) {
            return $router->route($route);
        }

        return $router->exec($controller, $action);
    }

    public function __get($method)
    {
        if (array_key_exists($method, App::$components)) {
            return App::$components->$method;
        }

        return parent::__get($method);
    }
}
