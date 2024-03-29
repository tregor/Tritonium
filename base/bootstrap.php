<?php
/**
 * Autoloader making include of vendor packages, core files and some other base files.
 *
 * Global variables:
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

use Tritonium\Base\App;


const ROOT = __DIR__ . "/../";
const DIR_ROOT = __DIR__ . "/../";
const DIR_APP = __DIR__ . "/../app/";
const DIR_BASE = __DIR__ . "/../base/";
const DIR_CONFIG = __DIR__ . "/../config/";
const DIR_LOGS = __DIR__ . "/../logs/";
const DIR_VIEW = __DIR__ . "/../view/";
const DIR_WEB = __DIR__ . "/../web/";

const DIR_CONTROLLERS = __DIR__ . "/../app/controllers/";
const DIR_MODELS = __DIR__ . "/../app/models/";
const DIR_SERVICES = __DIR__ . "/../app/services/";

@define("WEB_ROOT", $_SERVER['SERVER_NAME'] ?? basename(dirname(__DIR__)));
@define("WEB_SRC", WEB_ROOT . 'src/');
@define("WEB_CSS", WEB_ROOT . 'src/css/');
@define("WEB_IMG", WEB_ROOT . 'src/img/');
@define("WEB_JS", WEB_ROOT . 'src/js/');

session_start();
date_default_timezone_set('america/los_angeles');

require_once(DIR_ROOT . "vendor/autoload.php");
require_once(DIR_ROOT . "config/config.php");
require_once(DIR_BASE . "functions.php");
require_once(DIR_BASE . "BaseClass.php");
require_once(DIR_BASE . "App.php");

spl_autoload_register([App::class, 'loadClass']);
