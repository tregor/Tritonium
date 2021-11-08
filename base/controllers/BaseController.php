<?php

namespace Tritonium\Base\Controllers;

class BaseController
{
	private $controllerName;
	private $controllerAction;

	public function __construct(){
		$this->controllerName = get_class($this);
	}

	public function execute($action)
	{
		$this->controllerAction = "action".$action;
		if (method_exists($this->controllerName, $this->controllerAction)) {
			return call_user_func([$this->controllerName, $this->controllerAction]);
		}else{
			throw new \Exception('Action \"' . $this->controllerAction . '\" not found in controller \"' . $this->controllerName . '\".');
		}
	}
}