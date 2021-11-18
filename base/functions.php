<?php

function toCamelCase($string, $delimiter = "-"){
    return str_replace($delimiter, '', ucwords($string, $delimiter));
}

function toSnakeCase($string){
	return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
}

function require_path($path)
{
    $files = scandir($path);
    foreach ($files as $file) {
        if (preg_match("/(.*)\.php/", $file)) {
            require_once $path . "/" . $file;
        }
    }
}