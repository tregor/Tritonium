<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */

$config = [
    'app' => [
        'debug' => TRUE,
        'root' => dirname(__DIR__),
    ],
    'components' => [
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
    ],
    'log' => [
        'name'      => 'Tritonium',
        'path'      => 'logs/main.log',
        'level'     => 'debug',
        'period'    => 30,
    ],
];