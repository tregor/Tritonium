<?php

namespace Tritonium\Base;

class BaseException extends \Exception
{
	public function __construct($type, $message = null, $code = 0)
	{
		parent::__construct($type . ': ' . $message, $code);
	}
}