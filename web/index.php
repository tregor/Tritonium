<?php
/**
 * index.php file recently used to be starting point of scipt
 * Better usage is to use index.php as a router file for project
 */
require_once __DIR__ . '/../app/bootstrap.php';

$req = $_SERVER['REQUEST_URI'];
var_dump($req);

$req = preg_replace('/\?.*/', '', $req);
var_dump($req);

$req = explode("/", $req);
var_dump($req);