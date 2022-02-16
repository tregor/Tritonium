<?php

namespace Tritonium\Base;

class BaseClass extends \StdClass
{

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

    public function toArray()
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
}