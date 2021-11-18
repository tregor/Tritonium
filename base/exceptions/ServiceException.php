<?php

namespace Tritonium\Base\Exceptions;

class ServiceException extends BaseException
{
	private $code = 3000;

	public function __construct($service, $message = null, $context = [])
	{
		parent::__construct($service::class, $message, $context = []);
	}
}