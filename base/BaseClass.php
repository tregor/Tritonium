<?php

namespace Tritonium\Base;

use JetBrains\PhpStorm\ArrayShape;

class BaseClass extends \StdClass
{
    private $events = [];

    public function __clone()
    {
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

        return null;
    }

    public function __set($name, $value): void
    {
        $this->$name = $value;
    }

    #[ArrayShape(['className' => "string"])]
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

    public function __wakeup()
    {
    }

    public function getClassName()
    {
        $path = explode('\\', $this::class);
        return array_pop($path);
    }

    public function getClassNameFull()
    {
        return get_class($this);
    }

    public function off($name, $function = null)
    {
        if ($function === null) {
            unset($this->events[$name]);
        } else {
            $this->events[$name] = array_filter(
                $this->events[$name],
                function ($handler) use ($function) {
                    return $handler[0] !== $function;
                }
            );
        }
    }

    public function on($name, $function, $stop = false)
    {
        $event = new BaseEvent();
        $event->name = $name;
        $event->stop = $stop;

        $this->events[$name][] = [
            $function,
            $event,
        ];
    }

    public function trigger($name, $data = [])
    {
        if (isset($this->events[$name])) {
            $handlers = $this->events[$name];

            foreach ($handlers as $handler) {
                $event = $handler[1];
                $event->initiator = $this;
                $event->data = $data;

                call_user_func($handler[0], $event);
            }
        }
    }
}
