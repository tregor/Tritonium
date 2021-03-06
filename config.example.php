<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */

$config = [
    'app' => [
        'env' => 'dev',
        'debug' => TRUE,
        'root' => __DIR__,
        'server' => basename(__DIR__),
    ],
    'components' => require __DIR__ . '/components.php',
    'log' => [
        'name'      => 'Tritonium',
        'path'      => 'logs/main.log',
        'level'     => 'debug',
        'period'    => 30,
    ],
];