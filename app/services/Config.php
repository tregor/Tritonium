<?php

namespace Tritonium\App\Services;

class Config
{
	private static $cfg = [];

	private function __construct() { }

	static function getAll() { return self::$cfg; }

	static function get($key)
	{
		return isset(self::$cfg[$key]) ? self::$cfg[$key] : NULL;
	}

	static function set($key, $value)
	{
		if (!defined($key)) {
			define($key, $value);
		}
		self::$cfg[$key] = $value;
	}
}