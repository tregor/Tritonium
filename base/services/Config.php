<?php

namespace Tritonium\Base\Services;


class Config
{
    private static $cfg = [];

    private function __construct() {}

    static function get($key) {
        return isset(self::$cfg[$key]) ? self::$cfg[$key] : NULL;
    }

    static function getAll() { return self::$cfg; }

    static function set($key, $value) {
        if ( ! defined($key)) {
            define('cfg_' . $key, $value);
        }
        self::$cfg[$key] = $value;
    }
}