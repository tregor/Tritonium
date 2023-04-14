<?php

namespace Tritonium\Base\Models;

class ActiveMigrations extends ActiveModel
{
    public const STATUS_NOT_CREATED = 0;
    public const STATUS_READY = 1;
    public const STATUS_PROCESS = 2;
    public const STATUS_ERROR = 3;
    public const STATUS_DELETED = 4;
    /**
     * @var string Table in which model's data is stored
     */
    protected string $table = 'migrations';
}
