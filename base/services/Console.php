<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\Services\Config;
use Exception;

class Console
{
	public static $args;

	public static function error($str, $fatal = FALSE){
		Console::print($str, 'e', $fatal);
	}

	public static function warning($str, $fatal = FALSE){
		Console::print($str, 'w', $fatal);
	}

	public static function success($str, $fatal = FALSE){
		Console::print($str, 's', $fatal);
	}

	public static function info($str, $fatal = FALSE){
		Console::print($str, 'i', $fatal);
	}

	public static function print($str, $type = "", $fatal = FALSE)
	{
		$timestamp = time();

		switch ($type) {
			case 'error':
			case 'e': //error
				$color = "\033[31m";
				break;
			case 'warning':
			case 'w': //warning
				$color = "\033[33m";
				break;
			case 'success':
			case 's': //success
				$color = "\033[32m";
				break;
			case 'info':
			case 'i': //info
				$color = "\033[36m";
				break;
			default:
				$color = "\033[0m";
				break;
		}
		printf($color . "[%d]\t%s\t%s", $timestamp, date("d.m.Y H:i:s", $timestamp), $str);
		printf("\033[0m\n");

		if ($fatal) {
			die();
		}
	}

	public function input($label = '(Y/n) ')
	{
		return readline($label);
	}
}