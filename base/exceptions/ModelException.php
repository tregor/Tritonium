<?php

namespace Tritonium\Base\Exceptions;

class ModelException extends BaseException
{
	private $code = 2000;

	public function __construct($model, $message = null, $context = [])
	{
		parent::__construct($model::class, $message, $context);
	}
}