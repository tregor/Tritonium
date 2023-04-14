<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */

$config = [
    'app' => [
        'name' => 'Tritonium',
        'debug' => true,
    ],
    'components' => require __DIR__ . '/components.php',
];
