<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */

$config = [
    //General settings
    "TMD_DEBUG" => TRUE,

    //Logs config
    "LOG_NAME" => "Tritonium",
    "LOG_PATH" => "log/main.log",
    "LOG_LEVEL" => "debug",
    "LOG_PERIOD" => 30,

    //PDO config
    "PDO_TYPE" => "mysql",
    "PDO_HOST" => "localhost",
    "PDO_NAME" => "admin_GoodLog",
    "PDO_USER" => "admin_GoodLog",
    "PDO_PASS" => "NKIl5RVnTo",

    //Web config
    "SITE_NAME" => "Tritonium 2.0",
    "SITE_ROOT" => "https://dev.tregor.space/",
    "SRC_ROOT" => "https://dev.tregor.space/web/src/",
    "DIR_ROOT" => __DIR__."/../",
];