<?php

namespace Tritonium\Base\Exceptions;

class BaseException extends \Exception
{
	private $initiator;
	private $context = [];
	protected $code = 0;

	public function __construct($initiator, $message = "", $context = [])
	{
		$this->initiator = $initiator;
		$this->context = $context;

		parent::__construct($this->composeMessage($message), $this->code);
	}

	public function composeMessage($message)
	{
		return sprintf(
			"\r\nInitiator: %s\r\nMessage: %s\r\nContext: %s\r\n", 
			$this->initiator,
			$message,
			print_r($this->context, TRUE)
		);
	}
}