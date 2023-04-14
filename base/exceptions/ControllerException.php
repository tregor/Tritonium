<?php

namespace Tritonium\Base\Exceptions;

class ControllerException extends BaseException
{
    protected $code = 1000;

    public function __construct($message = null, $context = [])
    {
        parent::__construct($message, $context);
    }
}
