<?php

namespace Tritonium\Base\Services;


class Console
{
    public static $args;
    public static bool $isTerminal = false;

    public static function args($key = null)
    {
        if (!empty(Console::$args)) {
            return ($key === null) ? Console::$args : (Console::$args[$key] ?: null);
        }

        return null;
    }

    public static function error($str, $fatal = false)
    {
        Console::print($str, 'e', $fatal);
    }

    public static function print($str, $type = "", $fatal = false)
    {
        $timestamp = time();

        $color = match ($type) {
            'error', 'e' => "\033[31m",
            'warning', 'w' => "\033[33m",
            'success', 's' => "\033[32m",
            'info', 'i' => "\033[36m",
            default => "\033[0m",
        };
        printf($color . "[%d]\t%s\t%s", $timestamp, date("d.m.Y H:i:s", $timestamp), $str);
        printf("\033[0m\n");

        if ($fatal) {
            die();
        }
    }

    public static function info($str, $fatal = false)
    {
        Console::print($str, 'i', $fatal);
    }

    public static function init($args = [])
    {
        if ($args[0] == 'tmd') {
            unset($args[0]);
            Console::$args = $args;
            Console::$isTerminal = true;
        }
    }

    public static function input($label = '(Y/n) ')
    {
        return readline($label);
    }

    public static function success($str, $fatal = false)
    {
        Console::print($str, 's', $fatal);
    }

    public static function warning($str, $fatal = false)
    {
        Console::print($str, 'w', $fatal);
    }
}
