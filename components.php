<?php
/**
 * Components file initialize Core components
 */

use Tritonium\Base\Services\Request;
use Tritonium\Base\Services\View;
use Tritonium\Base\Services\Console;
// use Tritonium\Base\Services\PDO;

$config['components'] = [
    // 'database' => [
    //     'class' => \PDO::class,
    //     'data' => [
    //         'dsn' => 'mysql:dbname=Muz_TikTokBot;host=localhost',
    //         'user' => 'mysqladmin',
    //         'password' => 'ia7aijee4Eiz',
    //     ],
    // ],
    'db' => [
        'class' => Tritonium\Base\Services\PDO::class,
        'data' => [
            'type' => 'mysql',
            'host' => 'localhost',
            'name' => 'Muz_TikTokBot',
            'user' => 'mysqladmin',
            'pass' => 'ia7aijee4Eiz',
        ],
    ],
    // 'console' => Console::class,
    'request' => Request::class,
    'view' => View::class,
];