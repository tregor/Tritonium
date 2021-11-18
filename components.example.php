<?php
/**
 * Components file initialize Core components
 */

use Tritonium\Base\Services\Request;
use Tritonium\Base\Services\View;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\PDO;

return [
        'db' => [
            'class' => Tritonium\Base\Services\PDO::class,
            'data' => [
                'type' => 'mysql',
                'host' => 'localhost',
                'name' => 'dbname',
                'user' => 'root',
                'pass' => '',
            ],
        ],
        'console' => Console::class,
        'request' => Request::class,
        'view' => View::class,
    ];