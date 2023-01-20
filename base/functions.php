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

// copies files and non-empty directories
function rcopy($src, $dst) {
    if (is_dir($dst)) {
        $files = scandir($dst);
        foreach ($files as $file) {
            // code...
        }
    }
    if (file_exists($dst)) rmdir($dst);
    if (is_dir($src)) {
        mkdir($dst);
        $files = scandir($src);
        foreach ($files as $file)
        if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
    } else if (file_exists($src)) {
        if (file_exists($dst)) {
            unlink($dst);
        }
        copy($src, $dst);
    }
}

/*
 * Return num in short format (1.1K, 2M ...)
 */
function shortNumber($num)
{
	$units = ['', 'K', 'M', 'B', 'T'];
	for ($i = 0; $num >= 1000; $i++) {
		$num /= 1000;
	}
	return round($num, 1) . $units[$i];
}