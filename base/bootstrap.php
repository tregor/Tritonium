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
 * https://www.phparch.com/2017/09/generating-autoloader-legacy-php-codebase/
 * https://www.phptutorial.net/php-oop/php-composer-autoload/
 * https://componette.org/baraja-core/class-map-generator/
 * https://github.com/varunsridharan/php-classmap-generator
 * 
 */


use Tritonium\Base\Core;
use Tritonium\Base\Services\Config;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\View;
use Tritonium\Base\Services\Request;

define("ROOT",               __DIR__ . "/../");
define("DIR_ROOT",           __DIR__ . "/../");
define("DIR_APP",            __DIR__ . "/../app/");
define("DIR_BASE",           __DIR__ . "/../base/");

define("DIR_CONTROLLERS",	 __DIR__ . "/../app/controllers/");
define("DIR_MODELS",		 __DIR__ . "/../app/models/");
define("DIR_SERVICES",		 __DIR__ . "/../app/services/");

require_once(DIR_ROOT . "vendor/autoload.php");
require_once(DIR_ROOT . "config.php");
require_once(DIR_ROOT . "components.php");
require_once(DIR_BASE . "functions.php");

/**
 * Loading base components
 */
require_path(DIR_BASE);
require_path(DIR_BASE . "services/");
require_path(DIR_BASE . "models/");
require_path(DIR_BASE . "controllers/");
require_path(DIR_BASE . "exceptions/");

/**
 * Loading app components
 */
require_path(DIR_APP . "services/");
require_path(DIR_APP . "models/");
// require_path(DIR_APP . "controllers/");  // We don't need to include all controllers, bcs we will include only controller that we need. But later TODO: make class and components mapper!


/**
 * Settings from config.php
 */
// foreach($config as $key => $val){
//     Config::set($key, $val);
// }

if (Core::isDebug()) {
    ini_set('log_errors', TRUE); // Error/Exception file logging engine.
    ini_set("display_errors", TRUE);
    ini_set('ignore_repeated_errors', TRUE); // always use TRUE
    ini_set("error_reporting", E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); // Error/Exception engine, always use E_ALL
    ini_set('error_log', DIR_ROOT . "log/errors.log"); // Logging file path
}

Console::$args = $argv;
// Core::$app = new App();
Core::init($config);

session_start();