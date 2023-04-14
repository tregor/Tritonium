<?php

namespace Tritonium\Base\Services;


class Config
{
    private static $cfg = [];

    private function __construct()
    {
    }

    public static function get($key)
    {
        return self::$cfg[$key] ?? null;
    }

    public static function getAll()
    {
        return self::$cfg;
    }

    public static function set($key, $value)
    {
        if (!defined($key)) {
            define('cfg_' . $key, $value);
        }
        self::$cfg[$key] = $value;
    }
}
