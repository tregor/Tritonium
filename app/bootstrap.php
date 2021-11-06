<?php
/**
 * Autoloader making include of vendor packages, Core files and some other base files.
 * 
 * Global variables:
 * @var $core Core class maintaining app 
 * 
 * Request as static class used inside controller for expamle
 * 
 * TODO:
 * https://medium.com/the-andela-way/how-to-build-a-basic-server-side-routing-system-in-php-e52e613cf241
 */


use Tritonium\App\Services\Core;

define("ROOT",				 __DIR__ . "/../");
define("DIR_APP",            __DIR__ . "/../app/");
define("DIR_BASE",           __DIR__ . "/../app/base/");
define("DIR_CONTROLLERS",	 __DIR__ . "/../app/controllers/");
define("DIR_MODELS",		 __DIR__ . "/../app/models/");
define("DIR_SERVICES",		 __DIR__ . "/../app/services/");
define("DIR_LIBS",			 __DIR__ . "/../libs/");

require_once(ROOT . "vendor/autoload.php");


ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set("display_errors", TRUE);
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set("error_reporting", E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); // Error/Exception engine, always use E_ALL
ini_set('error_log', ROOT."log/errors.log"); // Logging file path

includePath(DIR_MODELS);
includePath(DIR_LIBS);
includePath(DIR_SERVICES);
includePath(DIR_BASE);
includePath(DIR_CONTROLLERS);

require_once DIR_APP . "config.php";
require_once DIR_APP . "functions.php";
// include_once ROOT . "view/defaults.php";

session_start();

function includePath($path)
{
	$files = scandir($path);
	foreach ($files as $file) {
		if (preg_match("/(.*)\.php/", $file)) {
			include $path . "/" . $file;
		}
	}
}