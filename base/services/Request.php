<?php

namespace Tritonium\Base\Services;

class Request
{

	/**
	 * @var string GET, POST etc
	 */
	protected static $request_method;

	/**
	 * @var string Current url
	 */
	protected static  $url;

	/**
	 * @var string Request params
	 */
	protected static  $params;

	/**
	 * @var string GET params
	 */
	protected static  $get;

	/**
	 * @var string POST params
	 */
	protected static  $post;

	public static function init()
	{
		$info = parse_url($_SERVER['REQUEST_URI']);
		parse_str($info['query'], $query);
		self::$request_method = $_SERVER['REQUEST_METHOD'];
		self::$url = $info['path'];
		self::$get = $query;
		self::$post = $_POST;
		self::$params = $_REQUEST;
	}

	public static function input($name, $method = NULL)
	{
		self::init();
		$data = self::$params;
		if (strtoupper($method) == "POST"){
			$data = self::$post;
		}
		if (strtoupper($method) == "GET"){
			$data = self::$get;
		}

		if (!empty($data[$name])) {
			return $data[$name];
		} else {
			throw new \Exception('Param '.$name.' not found');
		}
	}

	public static function inputAll($method = NULL)
	{
		self::init();
		$data = self::$params;
		if (strtoupper($method) == "POST"){
			$data = self::$post;
		}
		if (strtoupper($method) == "GET"){
			$data = self::$get;
		}

		return $data;
	}

	public static function method(){
		self::init();
		return self::$request_method;
	}

	public function url(){
		self::init();
		return self::$url;
	}
}