<?php

namespace Tritonium\Base\Exceptions;

class BaseException extends \Exception
{
    protected $code = 0;
    private $initiator;
    private $context = [];

    public function __construct($message = "", $context = [])
    {
        $this->initiator = $this::class;
        $this->context = $context;

        parent::__construct($this->composeMessage($message), $this->code);
    }

    public function composeMessage($message)
    {
        return sprintf(
            "\r\nInitiator: %s\r\nMessage: %s\r\nContext: %s\r\n",
            $this->initiator,
            $message,
            print_r($this->context, true)
        );
    }
}
