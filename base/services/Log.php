<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\BaseService;
use \Monolog\Handler\RotatingFileHandler;
use \Monolog\Logger;

class Log extends BaseService
{
	private static $logger;

	private function __construct()
	{
		$logger = new Logger('main');
		$logger->pushHandler(new RotatingFileHandler(ROOT . '/log/main.log', 30, Logger::WARNING));
		$logger->pushHandler(new RotatingFileHandler(ROOT . '/log/debug.log', 3, Logger::DEBUG));

		self::$logger = $logger;

		return self::$logger;
	}

	public static function write($message, $level = Logger::INFO)
	{
		if (empty(self::$logger)) new self();

		self::$logger->log($level, $message);
	}

	public static function debug($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::DEBUG, $message);
	}

	public static function info($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::INFO, $message);
	}

	public static function warning($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::WARNING, $message);
	}

	public static function error($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::ERROR, $message);
	}

	public static function critical($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::CRITICAL, $message);
	}

	public static function alert($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::ALERT, $message);
	}

	public static function emergency($message)
	{
		if (empty(self::$logger)) new self();
		self::$logger->log(Logger::EMERGENCY, $message);
	}
}