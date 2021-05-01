<?php
/**
 * Config file must be on every project. It contains main settings for project.
 * All settings must was set only here
 */
use core\services\Config;

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

//Настройки сайта
Config::set("SITE_NAME", "Tritonium");
Config::set("SITE_ROOT", "https://dev.tregor.ru/");
Config::set("SRC_ROOT", "https://dev.tregor.ru/src/");

//Настройки проекта