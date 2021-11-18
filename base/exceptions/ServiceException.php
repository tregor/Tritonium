<?php

namespace Tritonium\Base\Exceptions;

class ServiceException extends BaseException
{
	protected $code = 3000;

	public function __construct($message = null, $context = [])
	{
		parent::__construct(get_called_class(), $message, $context);
	}
}