<?php

namespace Tritonium\Base;

class BaseEvent
{
    public $name;
    public $initiator;
    public $data;
    public $stop = false;      // If TRUE die()

    public function getName()
    {
        return $this->name;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getInitiator()
    {
        return get_class($this->initiator);
    }
}
