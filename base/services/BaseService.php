<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\BaseClass;

class BaseService extends BaseClass
{
    public function __construct($data = [])
    {
        BaseClass::configure($this, $data);
    }

	public function __set($name, $value): void
	{
		$this->$name = $value;
	}

    private function __clone() { }

    private function __wakeup() { }
}