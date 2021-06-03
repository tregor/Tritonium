<?php
/**
 * Autoloader making include of vendor packages, Core files and some other base files.
 */

use Tritonium\Services\Core;

ini_set("display_errors", TRUE);
error_reporting(E_ALL);

define("CORE", __DIR__ . "/");
define("ROOT", __DIR__ . "/../");

include_once(CORE . "vendor/autoload.php");

includePath(CORE . "models");
includePath(CORE . "services");
includePath(CORE . "libs");

include_once CORE . "view/defaults.php";
include_once CORE . "config.php";
include_once CORE . "functions.php";

if (!Core::isInstalled()){
	Core::consolePrint("Tritonium is not installed yet! Please, install with core/commands/install.php.", "e", TRUE);
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