<?php

namespace Tritonium\Base\Models;

class ActiveMigrations extends ActiveModel
{
    const STATUS_NOT_CREATED = 0;
    const STATUS_READY       = 1;
    const STATUS_PROCESS     = 2;
    const STATUS_ERROR       = 3;
    const STATUS_DELETED     = 4;
    /**
     * @var string Table in which model's data is stored
     */
    protected string $table = 'migrations';
}