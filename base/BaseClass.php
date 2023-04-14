<?php

namespace Tritonium\Base;

class BaseClass extends \StdClass
{
	private $events = [];

    public function __set($name, $value): void
    {
        $this->$name = $value;
    }

    public function __get($method)
    {
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        $method = 'get' . $method;
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return NULL;
    }

    public function __clone() { }

    public function __wakeup() { }

    public function __toArray()
    {
        $reflection = new \ReflectionClass($this);
        $props = $reflection->getProperties();

        $array = [
            'className' => $reflection->getName(),
        ];

        foreach ($props as $prop) {
            $key = $prop->getName();
            $value = $this->$key;
            $array['props'][$key] = $value;
        }

        return $array;
    }

    public function getClassName() {
        $path = explode('\\', $this::class);
        return array_pop($path);
    }
    public function getClassNameFull() {
        return get_class($this);
    }
	
	public function trigger($name, $data = []){
		if (isset($this->events[$name])){
			$handlers = $this->events[$name];
			
			foreach ($handlers as $handler){
				$event = $handler[1];
				$event->initiator = $this;
				$event->data = $data;
				
				call_user_func($handler[0], $event);
			}
		}
	
	}
	
	public function on($name, $function, $stop = FALSE){
		$event = new BaseEvent();
		$event->name = $name;
		$event->stop = $stop;
		
		$this->events[$name][] = [
			$function,
			$event,
		];
	}
	
	public function off($name, $function = NULL){
	
	}
}