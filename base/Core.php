<?php

namespace Tritonium\Base;

use PDO;
use Exception;
use Tritonium\Base\Services\Config;
use Tritonium\Base\Services\Log;

class Core extends BaseComponent
{
	public static $app;

	public static $components;

	public static function init($config)
	{
		static::components($config['components']);
	}

	public static function components($components = [])
	{
		if (static::$components === NULL) {
			static::$components = new \StdClass();
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
				static::configure($object, $component['data']);
			}

			if (empty($object)) {
				throw new BaseException('InvalidConfigException', 'Unsupported component type: ' . gettype($component) . ', alias: ' . $alias);
			}

			static::$components->$alias = $object;
		}	

		return static::$components;
	}

	/**
	 * Configures an object with the initial property values.
	 * @param object $object the object to be configured
	 * @param array $properties the property initial values given in terms of name-value pairs.
	 * @return object the object itself
	 */
	public static function configure($object, $properties)
	{
		foreach ($properties as $name => $value) {
			$object->$name = $value;
		}

		return $object;
	}

	/**
	 * Returns the public member variables of an object.
	 * This method is provided such that we can get the public member variables of an object.
	 * It is different from "get_object_vars()" because the latter will return private
	 * and protected variables if it is called within the object itself.
	 * @param object $object the object to be handled
	 * @return array the public member variables of the object
	 */
	public static function getObjectVars($object)
	{
		return get_object_vars($object);
	}

	public static function isInstalled(){
		if (file_exists(__DIR__."/installation.json")){
			$infoJson = file_get_contents(__DIR__."/installation.json");
			$info = json_decode($infoJson, TRUE);

			if ($info['needInstall']){
				return FALSE;
			}
			if ($info['needUpdate']){
				return FALSE;
			}
			if ($info['needReinstall']){
				return FALSE;
			}

			return TRUE;
		}else{
			return FALSE;
		}
	}

	public static function getInstallation(){
		if (self::isInstalled()){
			$infoJson = file_get_contents(__DIR__."/installation.json");
			$info = json_decode($infoJson, TRUE);

			return $info;
		}

		return FALSE;
	}

	public static function isDebug()
	{
		return Config::get("TMD_DEBUG");
	}
}