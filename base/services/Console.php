<?php

namespace Tritonium\Base\Services;


class Console
{
    public static $args;
    public static bool $isTerminal = FALSE;
    
    public static function args($key = NULL) {
        if ( ! empty(Console::$args)) {
            return ($key === NULL) ? Console::$args : (Console::$args[$key] ?: NULL);
        }
        
        return NULL;
    }
    
    public static function error($str, $fatal = FALSE) {
        Console::print($str, 'e', $fatal);
    }
    
    public static function info($str, $fatal = FALSE) {
        Console::print($str, 'i', $fatal);
    }
    
    public static function init($args = []) {
        if ($args[0] == 'tmd') {
            unset($args[0]);
            Console::$args       = $args;
            Console::$isTerminal = TRUE;
        }
    }
    
    public static function input($label = '(Y/n) ') {
        return readline($label);
    }
    
    public static function print($str, $type = "", $fatal = FALSE) {
        $timestamp = time();
        
        switch ($type) {
            case 'error':
            case 'e': //error
                $color = "\033[31m";
                break;
            case 'warning':
            case 'w': //warning
                $color = "\033[33m";
                break;
            case 'success':
            case 's': //success
                $color = "\033[32m";
                break;
            case 'info':
            case 'i': //info
                $color = "\033[36m";
                break;
            default:
                $color = "\033[0m";
                break;
        }
        printf($color . "[%d]\t%s\t%s", $timestamp, date("d.m.Y H:i:s", $timestamp), $str);
        printf("\033[0m\n");
        
        if ($fatal) {
            die();
        }
    }
    
    public static function success($str, $fatal = FALSE) {
        Console::print($str, 's', $fatal);
    }
    
    public static function warning($str, $fatal = FALSE) {
        Console::print($str, 'w', $fatal);
    }
}