<?php

namespace Tritonium\Base\Services;

class Request extends BaseService 
{
	/**
	 * @var array Parsed $_SERVER['REQUEST_URI']
	 */
	private $rawData = [];

	/**
	 * @var string Request method, "POST", "GET", "PUT" and etc.
	 */
	protected $method = "GET";

	/**
	 * @var string Request body payload
	 */
	protected $body = NULL;

	/**
	 * @var array Request path from root
	 */
	protected $path = [];

	/**
	 * @var array Parsed request headers
	 */
	protected $headers = [];

	/**
	 * @var array Parsed request headers
	 */
	protected $cookies = [];

	/**
	 * @var array GET params
	 */
	protected $paramsGET = [];

	/**
	 * @var array POST params
	 */
	protected $paramsPOST = [];

	public function __construct()
	{
		$this->rawData 		= parse_url(@$_SERVER['REQUEST_URI']) ?: [];
		$this->method 		= @$_SERVER['REQUEST_METHOD'] ?: "GET";
		// $this->path 		= array_filter(explode("/", ($this->rawData['path'] ?: "/")));
		$this->path 		= $this->rawData['path'] ?: "/";
		$this->body 		= file_get_contents("php://input");
		$this->headers 		= getallheaders();
		$this->cookies 		= $_COOKIE;	//TODO: Create CookieJar object
		$this->paramsGET 	= $_GET;
		$this->paramsPOST 	= $_POST;
	}

	public function isPOST()
	{
		return ($this->method == "POST");
	}

	public function isGET()
	{
		return ($this->method == "GET");
	}

	public function method()
	{
		return $this->method;
	}

	public function path()
	{
		return $this->path;
	}

	public function body()
	{
		return $this->body;
	}

	public function headers()
	{
		return $this->headers;
	}

	public function cookies()
	{
		return $this->cookies;
	}

	public function get($key)
	{
		return $this->paramsGET[$key];
	}

	public function post($key)
	{
		return $this->paramsPOST[$key];
	}

	public function input($name, $method = NULL)
	{
		$params = array_merge($this->paramsGET, $this->paramsPOST);
	
		if (strtoupper($method) == "GET"){
			$data = $this->paramsGET;
		}
		if (strtoupper($method) == "POST"){
			$data = $this->paramsPOST;
		}

		if (!empty($data[$name])) {
			return $data[$name];
		} else {
			throw new \Exception('Param '.$name.' not found');
		}
	}

	public function inputAll($method = NULL)
	{
		$params = array_merge($this->paramsGET, $this->paramsPOST);
	
		if (strtoupper($method) == "GET"){
			$data = $this->paramsGET;
		}
		if (strtoupper($method) == "POST"){
			$data = $this->paramsPOST;
		}

		return $data;
	}
}