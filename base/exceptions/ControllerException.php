<?php

namespace Tritonium\Base\Exceptions;

class ControllerException extends BaseException
{
	private $code = 1000;

	public function __construct($controller, $message = null, $context = [])
	{
		parent::__construct($controller::class, $message, $model);
	}
}