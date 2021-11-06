<?php

namespace Tritonium\App\Services;

class Template
{
	private static $settings = [];

	private function __construct() { }

	static function getSettings() { return self::$settings; }

	static function get($key)
	{
		$keys = explode(".", $key);
		switch (count($keys)){
			case 1:
				return @self::$settings[$keys[0]];
			case 2:
				return @self::$settings[$keys[0]][$keys[1]];
			case 3:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]];
			case 4:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]];
			case 5:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]];
			case 6:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]];
			case 7:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]][$keys[6]];
			case 8:
				return @self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]][$keys[6]][$keys[7]];
			default:
				return NULL;
		}
	}

	static function set($key, $value)
	{
		$keys = explode(".", $key);
		switch (count($keys)){
			case 1:
				self::$settings[$keys[0]] = $value;
				break;
			case 2:
				self::$settings[$keys[0]][$keys[1]] = $value;
				break;
			case 3:
				self::$settings[$keys[0]][$keys[1]][$keys[2]] = $value;
				break;
			case 4:
				self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]] = $value;
				break;
			case 5:
				self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]] = $value;
				break;
			case 6:
				self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]] = $value;
				break;
			case 7:
				self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]][$keys[6]] = $value;
				break;
			case 8:
				self::$settings[$keys[0]][$keys[1]][$keys[2]][$keys[3]][$keys[4]][$keys[5]][$keys[6]][$keys[7]] = $value;
				break;
		}
	}

	static function has($key)
	{
		return (self::get($key) !== NULL);
	}

	static function demo(){
		return ((self::has("demo")) AND !(self::get("demo") == FALSE));
	}

	static function setDefaults($defaults){
		self::$settings = $defaults;
	}

	static function block($blockName){
		$blockName = str_replace(".", "/", $blockName);
		if (is_file(CORE."view/blocks/{$blockName}.php")){
			include CORE."view/blocks/{$blockName}.php";
		}
	}

	static function img($imageName)
	{
		return Config::get("SITE_SRC") . "img/{$imageName}";
	}

	static function css($cssFileName)
	{
		return Config::get("SITE_SRC") . "css/{$cssFileName}";
	}

	static function js($javascriptName)
	{
		return Config::get("SITE_SRC") . "js/{$javascriptName}";
	}
}