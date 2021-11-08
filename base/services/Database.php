<?php

namespace Tritonium\Base\Services;

use mysqli;

class Database
{
	private static $instance = NULL;

	private function __construct()
	{
		$mysqli = new mysqli(Config::get("MySQL_HOST"), Config::get("MySQL_USER"), Config::get("MySQL_PASS"), Config::get("MySQL_NAME"));
		if ($mysqli->connect_errno) {
			Log::error("MySQLi error #" . $mysqli->connect_errno . ": " . $mysqli->connect_error);
			throw new Exception("MySQLi error #" . $mysqli->connect_errno . ": " . $mysqli->connect_error);
		}
		self::$instance = $mysqli;

		return self::$instance;
	}

	public static function sql($query)
	{
		if (!$result = self::getInstance()->query($query)) {
			Log::error("MySQLi error #" . self::getInstance()->errno . ": " . self::getInstance()->error);
			die("MySQLi error #" . self::getInstance()->errno . ": " . self::getInstance()->error);
		}

		return $result;
	}

	public static function getInstance()
	{
		if (self::$instance != NULL) {
			return self::$instance;
		}

		new self;

		return self::$instance;
	}

	private function __clone() { }

	private function __wakeup() { }
}