<?php
/**
 * Components file initialize Core components
 */

use Tritonium\Base\Services\Request;
use Tritonium\Base\Services\View;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\PDO;

return [
        'console' => Console::class,
        'request' => Request::class,
        'view' => View::class,
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
        'router' => [
            'class' => Router::class,
            'data' => [
                'routes' => [
                    'admin' => 'DefaultController@index',

                    'admin/<modelname>/list' => 'ModelsController@modelList',
                    'admin/<modelname>/create' => 'ModelsController@modelCreate',
                    'admin/<modelname>/save' => 'ModelsController@modelSave',
                    'admin/<modelname>/<id>/save' => 'ModelsController@modelSave',
                    'admin/<modelname>/<id>/view' => 'ModelsController@modelView',
                    'admin/<modelname>/<id>/edit' => 'ModelsController@modelEdit',
                    'admin/<modelname>/<id>/copy' => 'ModelsController@modelCopy',
                    'admin/<modelname>/<id>/delete' => 'ModelsController@modelDelete',
                ],
            ],
        ],
        'sentry' => [
            'class' => Tritonium\Base\Services\SentryService::class,
            'data' => [
                'dsn' => 'https://12345678912345678912345678900@o123456.ingest.sentry.io/1234567',
                'level' => E_ALL,
                'defaults' => TRUE,
            ],
        ],
    ];