<?php

namespace Tritonium\Base\Services;

class Request extends BaseService
{
	/**
	 * @var string Request method, "POST", "GET", "PUT" and etc.
	 */
	protected $method = "GET";
	/**
	 * @var string Request body payload
	 */
	protected $body = null;
	/**
	 * @var array Request path from root
	 */
	protected $path = [];
	/**
	 * @var array Parsed request headers
	 */
	protected $headers = [];
	/**
	 * @var array $_COOKIES
	 */
	protected $cookies = [];
	/**
	 * @var array $_SESSION
	 */
	protected $session = [];
	/**
	 * @var array GET params
	 */
	protected $paramsGET = [];
	/**
	 * @var array POST params
	 */
	protected $paramsPOST = [];
	/**
	 * @var array Uploaded files
	 */
	protected $files = [];
	/**
	 * @var array Parsed $_SERVER['REQUEST_URI']
	 */
	private $rawData = [];
	
	public function __construct() {
		$this->rawData    = parse_url(@$_SERVER['REQUEST_URI']) ?: [];
		$this->method     = @$_SERVER['REQUEST_METHOD'] ?: "GET";
		$this->path       = ltrim(rtrim($this->rawData['path'] ?: "/", '/'), '/');
		$this->body       = file_get_contents("php://input");
		$this->headers    = getallheaders();
		$this->cookies    = $_COOKIE;     //TODO: Create CookieJar object
		$this->session    = $_SESSION;    //TODO: Make session object
		$this->paramsGET  = $_GET;
		$this->paramsPOST = $_POST;
		$this->files      = $_FILES;
		
		if (empty($this->paramsPOST)) {
			parse_str($this->body(), $this->paramsPOST);
		}
	}
	
	public function body() {
		return $this->body;
	}
	
	public function isPOST(): bool {
		return ($this->method == "POST");
	}
	
	public function isGET(): bool {
		return ($this->method == "GET");
	}
	
	public function method() {
		return $this->method;
	}
	
	public function path() {
		return $this->path;
	}
	
	public function headers() {
		return $this->headers;
	}
	
	public function header($key) {
		return $this->headers[$key];
	}
	
	public function headerExist($key) {
		return array_key_exists($key, $this->headers);
	}
	
	public function cookies(): array {
		return $this->cookies;
	}
	
	public function session(): array {
		return $this->session;
	}
	
	public function get($key) {
		return $this->paramsGET[$key];
	}
	
	public function post($key) {
		return $this->paramsPOST[$key];
	}
	
	public function inputAll($method = null): array {
		$data = array_merge($this->paramsGET, $this->paramsPOST);
		
		if (strtoupper($method) == "GET") {
			$data = $this->paramsGET;
		}
		if (strtoupper($method) == "POST") {
			$data = $this->paramsPOST;
		}
		
		return $data;
	}
	
	public function has($name, $method = null): bool {
		return ($this->input($name, $method) !== null);
	}
	
	public function input($name, $method = null) {
		$data = array_merge($this->paramsGET, $this->paramsPOST);
		
		if (strtoupper($method) == "GET") {
			$data = $this->paramsGET;
		}
		if (strtoupper($method) == "POST") {
			$data = $this->paramsPOST;
		}
		
		if ( ! empty($data[$name])) {
			return $data[$name];
		} else {
			// throw new \Exception('Param '.$name.' not found');
			return null;
		}
	}
	
	public function hasFiles(): bool {
		return ( ! empty($this->files));
	}
	
	public function uploadedFiles(): array {
		return $this->files;
	}
}