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

    private function __clone() { }

    private function __wakeup() { }
}