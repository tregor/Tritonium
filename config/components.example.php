<?php
/**
 * Components file initialize Core components
 */

use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\Request;
use Tritonium\Base\Services\Router;
use Tritonium\Base\Services\View;

return [
    'console' => Console::class,
    'request' => Request::class,
    'view' => View::class,
    'db' => [
        'class' => Tritonium\Base\Services\PDO::class,
        'data' => require __DIR__ . '/db.php',
    ],
    'router' => [
        'class' => Router::class,
        'data' => [
            'routes' => require __DIR__ . '/routes.php',
        ],
    ],
];
