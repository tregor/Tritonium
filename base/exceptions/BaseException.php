<?php

namespace Tritonium\Base\Exceptions;

class BaseException extends \Exception
{
	private $initiator;
	private $context;
	private $message;
	private $code = 0;

	public function __construct($initiator, $message = "", $context = [])
	{
		$this->initiator = $initiator;
		$this->context = $context;

		parent::__construct($this->composeMessage(), $this->code);
	}

	public function composeMessage()
	{
		return sprintf("Initiator: %s\r\nMessage: %s\r\nContext: %s", [$this->initiator, $this->message, print_r($this->context, TRUE)]);
	}
}