<?php

/**
 * index.php file recently used to be starting point of scipt
 * Better usage is to use index.php as a router file for project
 */
require_once __DIR__ . '/../base/bootstrap.php';

use Tritonium\Base\App;

App::init($config);
App::start('web');
