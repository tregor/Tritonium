<?php

namespace Tritonium\Base\Services;

/**
 *
 * App::$view->render('template.name', $params);
 * Will render HTML from "/view/template/name.php"
 * 
 * Inside template it can be includes like
 * App::$view->include('block.name');
 * Will include HTML from "/view/block/name.php"
 * Detect parent template inside!
 * 
 * TODO: Resources compilation and copy from "/view/src" to "/web/src" only useful!
 * TODO: Implement CSS and JS Assets like this: https://qna.habr.com/q/450128
 * 
 * 
 */
class View extends BaseService {
	protected $defaults = [];
	private $data = [];
	private $headers = [];
	private $httpcode = 200;

	public function renderJSON($result, $status = TRUE)
	{
		$data = [
			'status' => $status,
			'result' => $result,
		];
		print(json_encode($data, JSON_PRETTY_PRINT));
	}
	
	public function render($template = 'default', $data = [])
	{
		$this->data = $data;
		$data = array_merge_recursive($this->defaults, $this->data);

		ob_start();
		extract($data);
		require_once $this->parseTemplatePath($template);
		$output = ob_get_contents();
		ob_end_clean();

		$this->sendHeaders();
		printf("%s\r\n", $output);
	}

	public function include($template = 'default', $data = [])
	{
		$data = array_merge_recursive($this->defaults, $this->data, $data);

		ob_start();
		extract($data);
		require $this->parseTemplatePath($template);
		$output = ob_get_contents();
		ob_end_clean();

		printf("%s\r\n", $output);
	}

	protected function parseTemplatePath($template)
	{
		$file = str_replace(".", "/", $template) . ".php";
		$path = DIR_VIEW . $file;

		if (file_exists($path)) {
			return $path;
		}else{
			return FALSE;
		}
	}

	protected function sendHeaders()
	{
		foreach ($this->headers as $headerName => $headerValue){
			header("{$headerName}: {$headerValue}");
		}
	}

	public function setHeader($key, $value = '')
	{
		$this->headers[$key] = $value;
		return $this;
	}

	public function setCode($code = 200)
	{
		$this->httpcode = $code;
		return $this;
	}

	public function redirect($url, $code = 303)
	{
		$this->setHeader('Location', $url);
		$this->setCode($code);
		$this->sendHeaders();

		die('Redirected...');
	}

	// static function img($imageName)
	// {
	// 	return Config::get("SITE_SRC") . "img/{$imageName}";
	// }

	// static function css($cssFileName)
	// {
	// 	return Config::get("SITE_SRC") . "css/{$cssFileName}";
	// }

	// static function js($javascriptName)
	// {
	// 	return Config::get("SITE_SRC") . "js/{$javascriptName}";
	// }
}