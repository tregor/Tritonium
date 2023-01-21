<?php

namespace Tritonium\Base\Controllers;

use Exception;
use ReflectionMethod;
use Tritonium\Base\BaseClass;

class BaseController extends BaseClass
{
	protected $controllerName;
	protected $controllerAction;
	protected $beforeExclude = [];
	
	public function __construct() {
		$this->controllerName = get_class($this);
	}
	
	public function execute($action) {
		$this->controllerAction = 'action' . $action;
		if (method_exists($this->controllerName, $this->controllerAction)) {
			return @call_user_func([$this->controllerName, $this->controllerAction]);
		} else {
			throw new Exception('Action \"' . $this->controllerAction . '\" not found in controller \"' . $this->controllerName . '\".');
		}
	}
	
	public function action($action, $params = []) {
		$this->controllerAction = "action" . $action;
		//		if (method_exists($this->controllerName, 'beforeAction') && !in_array($this->controllerAction, $this->beforeExclude)) {
		//			$beforeStatus = @call_user_func([$this->controllerName, 'beforeAction']);
		//			if ($beforeStatus === FALSE) {
		//				throw new \Exception('Before action fucked in controller \"' . $this->controllerName . '\".');
		//			}
		//		}
		
		if (method_exists($this->controllerName, $this->controllerAction)) {
			$reflection = new ReflectionMethod($this->controllerName, $this->controllerAction);
			if (method_exists($this->controllerName, 'beforeAction') && ! in_array($this->controllerAction, $this->beforeExclude)) {
				$reflectionBefore = new ReflectionMethod($this->controllerName, 'beforeAction');
				$reflectionBefore->invoke($this);
			}
			
			$args = [];
			foreach ($reflection->getParameters() as $param) {
				/* @var $param ReflectionParameter */
				if (isset($params[$param->getName()])) {
					$args[] = $params[$param->getName()];
				} else {
					// @todo Add hasDefaultValue() and canBeNull()
					$args[] = $param->getDefaultValue();
				}
			}
			
			return $reflection->invokeArgs($this, $args);
		} else {
			throw new Exception('Action \"' . $this->controllerAction . '\" not found in controller \"' . $this->controllerName . '\".');
		}
		
		return null;
	}
}