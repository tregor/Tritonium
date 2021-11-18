<?php

namespace Tritonium\Base;

class BaseComponent extends \StdClass
{
    public function __construct($data = NULL)
    {
        Core::configure($this, $data);
    }

	public function __set($name, $value): void
	{
		$this->$name = $value;
	}
}