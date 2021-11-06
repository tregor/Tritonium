<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */
use Tritonium\App\Services\Config;

//Конфиг для Логов
Config::set("LOG_NAME", "Tritonium");
Config::set("LOG_PATH", ROOT."/log/main.log");
Config::set("LOG_LEVEL", "debug");
Config::set("LOG_PERIOD", 30);

//Конфиг для БД
Config::set("MYSQL_HOST", "localhost");
Config::set("MYSQL_USER", "root");
Config::set("MYSQL_PASS", "");
Config::set("MYSQL_NAME", "database");

//Конфиг для PDO
Config::set("PDO_TYPE", "mysql");
Config::set("PDO_HOST", "localhost");
Config::set("PDO_NAME", "admin_GoodLog");
Config::set("PDO_USER", "admin_GoodLog");
Config::set("PDO_PASS", "NKIl5RVnTo");

//Настройки сайта
Config::set("SITE_NAME", "Tritonium");
Config::set("SITE_ROOT", "https://dev.tregor.ru/");
Config::set("SRC_ROOT", "https://dev.tregor.ru/src/");
Config::set("DIR_ROOT", __DIR__."/../");

//Настройки проекта