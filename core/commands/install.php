<?php

include_once __DIR__."/../autoloader.php";

use core\services\Config;
use core\services\Log;
use Tritonium\Services\Core;

$installationData = [
	"needInstall" => TRUE,
	"needUpdate" => FALSE,
	"needReinstall" => FALSE,
	"info" => [
		"timestamp" => time(),
		"installationDate" => date("d.m.Y H:i:s"),
		"path" => __DIR__."/../../",
		"user" => posix_getpwuid(posix_geteuid()),
		"owner" => get_current_user(),
	],
	"modules" => [
		"Migrations" => FALSE,
	],
];


Core::consolePrint("Starting Tritonium installation.", "i");

//TODO: Функционал детекции перустановки с консольным UI
$connection = Core::getPDO();
if (!$connection){
	Core::consolePrint("Error while initializing PDO Connection!", "e", TRUE);
}else{
	Core::consolePrint("Connection to PDO initialized.", "s");
}

$sql = "CREATE TABLE IF NOT EXISTS migrations
(
	id        int      NOT NULL AUTO_INCREMENT,
	name      text,
	status    int,
	operation text,
	filename  text,
	datestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);";
if ($connection->exec($sql) === FALSE){
	Core::consolePrint("Error while creating table 'migrations!'", "e", TRUE);
}else{
	Core::consolePrint("Table 'migrations' successfully created!", "s", FALSE);
	$installationData['modules']['Migrations'] = TRUE;
}

$installationData['needInstall'] = FALSE;
file_put_contents(__DIR__."/../installation.json", json_encode($installationData));
Core::consolePrint("Installation finished!", "i");