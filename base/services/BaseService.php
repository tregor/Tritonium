<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\Core;

class BaseService extends \StdClass
{
    public function __construct($data = [])
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