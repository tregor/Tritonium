<?php

namespace Tritonium\Base\Services;

class BaseService extends BaseComponent
{
    public function __construct($data = NULL)
    {
        Core::configure($this, $data);
    }

	public function __set($name, $value): void
	{
		$this->$name = $value;
	}

    private function __clone() { }

    private function __wakeup() { }
}