<?php

namespace Tritonium\Base\Exceptions;

class ModelException extends BaseException
{
	protected $code = 2000;

	public function __construct($message = null, $context = [])
	{
		parent::__construct(get_called_class(), $message, $context);
	}
}