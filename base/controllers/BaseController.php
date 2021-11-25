<?php

namespace Tritonium\Base\Controllers;

use Tritonium\Base\BaseClass;

class BaseController extends BaseClass
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
			return @call_user_func([$this->controllerName, $this->controllerAction]);
		}else{
			throw new \Exception('Action \"' . $this->controllerAction . '\" not found in controller \"' . $this->controllerName . '\".');
		}
	}

	public function action($action, $params = [])
    {
		$this->controllerAction = "action".$action;
        if (method_exists($this->controllerName, $this->controllerAction)) {
            $reflection = new \ReflectionMethod($this->controllerName, $this->controllerAction);

	        $args = [];
	        foreach($reflection->getParameters() as $param)
	        {
	          /* @var $param ReflectionParameter */
	          if(isset($params[$param->getName()]))
	          {
	            $args[] = $params[$param->getName()];
	          } else {
	          	// @todo Add hasDefaultValue() and canBeNull()
	            $args[] = $param->getDefaultValue();
	          }
	        }

	        return $reflection->invokeArgs($this, $args);
        }else{
			throw new \Exception('Action \"' . $this->controllerAction . '\" not found in controller \"' . $this->controllerName . '\".');
		}

        return null;
    }
}