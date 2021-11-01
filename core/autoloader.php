<?php
/**
 * Autoloader making include of vendor packages, Core files and some other base files.
 */

use Tritonium\Services\Core;

define("CORE", __DIR__ . "/");
define("ROOT", __DIR__ . "/../");

ini_set("display_errors", TRUE);
ini_set("error_reporting", E_ALL); // Error/Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', ROOT."log/errors.log"); // Logging file path

include_once(CORE . "vendor/autoload.php");

includePath(CORE . "models");
includePath(CORE . "services");
includePath(CORE . "libs");

include_once CORE . "view/defaults.php";
include_once CORE . "config.php";
include_once CORE . "functions.php";

session_start();

if (!Core::isInstalled()){
	if (basename(__FILE__, '.php') != "install") {
		Core::consolePrint("Tritonium is not installed yet! Please, install with core/commands/install.php.", "e", TRUE);
	}
}

function includePath($path)
{
	$files = scandir($path);
	foreach ($files as $file) {
		if (preg_match("/(.*)\.php/", $file)) {
			include $path . "/" . $file;
		}
	}
}