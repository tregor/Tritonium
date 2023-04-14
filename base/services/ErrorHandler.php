<?php

namespace Tritonium\Base\Services;

use JetBrains\PhpStorm\NoReturn;
use ReflectionClass;
use Throwable;
use Tritonium\Base\App;


/**
 * PHP library for handling exceptions and errors.
 *
 * Class ErrorHandler
 *
 * @package   tregor
 *
 * @author    tregor<tregor1997@gmail.com>
 * @copyright 2019 (C) tregor
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/tregor/ErrorHandler
 * @since     1.0.0
 */
class ErrorHandler
{
    /* Array of error params */
    private $error;
    /* Array of error file params */
    private $file;
    /* Array of trace steps */
    private $backtrace;
    /* Array of view template */
    private $template = "light";
    /* Max count of trace steps */
    private $traceDepth = 0;

    /**
     * Initializing and setup handlers
     */
    function __construct($data = null)
    {
        if (App::$type == 'web') {
            set_exception_handler(null);
            set_error_handler(null);
        }
    }

    /**
     * Error handler
     *
     * @param integer $errno Error code
     * @param string $errstr Error message
     * @param string $errfile File where error is occured
     * @param integer $errline Line of file where error is occured
     *
     * @return void
     */
    public function catchError(int $errno, string $errstr, string $errfile, int $errline)
    {
        /* Setting params */
        $this->error = [
            "code" => $errno,
            "type" => $this->getErrorType($errno),
            "level" => $this->getErrorLevel($errno),
            "message" => $errstr,
        ];
        $this->file = [
            "name" => $errfile,
            "line" => $errline,
        ];
        $this->backtrace = debug_backtrace();
        if ($this->traceDepth > 0) {
            $this->backtrace = array_slice($this->backtrace, 0, $this->traceDepth);
        }

        /* Fix for Error Traces */
        array_shift($this->backtrace);

        /* Get part of code for each trace step */
        foreach ($this->backtrace as $index => $step) {
            if (!isset($step['file']) or !isset($step['line'])) {
                if (isset($step['class']) && isset($step['function'])) {
                    $this->backtrace[$index]['file'] = (new ReflectionClass($step['class']))->getFileName();
                    $this->backtrace[$index]['line'] = (new ReflectionClass($step['class']))->getMethod(
                        $step['function']
                    )->getStartLine();
                } else {
                    unset($this->backtrace[$index]);
                    continue;
                }
            }
            $this->file["preview"][] = $this->getFileLines(
                $this->backtrace[$index]['file'],
                $this->backtrace[$index]['line']
            );
            if (!isset($step['asString'])) {
                $this->backtrace[$index]['asString'] = $this->getAsStringTrace($step);
            }
        }

        for ($i = count($this->backtrace) - 1; $i >= 0; $i--) {
            if (isset($this->backtrace[$i - 1])
                && ($this->file['name'] == $this->backtrace[$i]['file'])
                && ($this->file['line'] == $this->backtrace[$i]['line'])) {
                unset($this->backtrace[$i - 1]);
                break;
            }
        }

        $this->render();
    }

    /**
     * Return error type by error code
     *
     * @param integer $errno Error code
     *
     * @return string         Error type
     */
    private static function getErrorType(int $errno)
    {
        /* E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR */
        if (($errno == 1) or ($errno == 16) or ($errno == 64) or ($errno == 256) or ($errno == 4096)) {
            return "ERROR";
        }
        /* E_WARNING, E_PARSE, E_CORE_WARNING, E_COMPILE_WARNING, E_USER_WARNING */
        if (($errno == 2) or ($errno == 4) or ($errno == 32) or ($errno == 128) or ($errno == 512)) {
            return "WARNING";
        }
        /* E_NOTICE, E_USER_NOTICE, E_STRICT, E_DEPRECATED, E_USER_DEPRECATED */
        if (($errno == 8) or ($errno == 1024) or ($errno == 2048) or ($errno == 8192) or ($errno == 16384)) {
            return "NOTICE";
        }

        return "DEBUG";
    }

    /**
     * Return error level by RFC-5424
     *
     * @param integer $errno Error code
     *
     * @return int         Error level from 3 to 5
     */
    private static function getErrorLevel(int $errno)
    {
        /* E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR */
        if (($errno == 1) or ($errno == 16) or ($errno == 64) or ($errno == 256) or ($errno == 4096)) {
            return 3;
        }
        /* E_WARNING, E_PARSE, E_CORE_WARNING, E_COMPILE_WARNING, E_USER_WARNING */
        if (($errno == 2) or ($errno == 4) or ($errno == 32) or ($errno == 128) or ($errno == 512)) {
            return 4;
        }
        /* E_NOTICE, E_USER_NOTICE, E_STRICT, E_DEPRECATED, E_USER_DEPRECATED */
        if (($errno == 8) or ($errno == 1024) or ($errno == 2048) or ($errno == 8192) or ($errno == 16384)) {
            return 5;
        }

        return 6;
    }

    /**
     * Getting lines from file to preview
     *
     * @param string $fileName Absolute path to file
     * @param integer $line Target line of file
     * @param integer $offset Number of lines before and after target
     *
     * @return string
     */
    private function getFileLines(string $fileName, int $line, int $offset = 5)
    {
        $file = file($fileName);
        $start = max(0, $line - $offset);
        $end = min(count($file), $line + $offset);
        $preview = "";

        for ($i = $start; $i != $end - 1; $i++) {
            if (!isset($file[$i])) {
                continue;
            }

            /* Making lines indentation */
            $text = trim($file[$i], "\n\r\0\x0B");
            $text = str_replace(["    ", "  "], "\t", $text);
            $text = str_replace("\t", "<span class=\"tab\"></span>", $text);

            /* 2 digits in index */
            $index = ($i < 9) ? "0" . ($i + 1) : ($i + 1);

            /* Current line is target line */
            if ($i == $line - 1) {
                $preview .= '<p class="line" id="target"><span class="index">' . $index . '.</span>' . $text . '</p>' . PHP_EOL;
            } else {
                $preview .= '<p class="line"><span class="index">' . $index . '.</span>' . $text . '</p>' . PHP_EOL;
            }
        }

        return $preview;
    }

    /**
     * Return trace step initiator as readable string
     *
     * @param array $trace Trace step
     *
     * @return string        Readable string of trace step
     */
    private function getAsStringTrace(array $trace)
    {
        /* Smart implode args with coolor effects :) */
        $arguments = [];
        if (isset($trace['args'])) {
            foreach ($trace['args'] as $arg) {
                switch (gettype($arg)) {
                    case 'string':
                        $argColor = "darkgreen";
                        $argStr = gettype($arg) . " \"$arg\"";
                        break;
                    case 'double':
                    case 'integer':
                        $argColor = "dodgerblue";
                        $argStr = gettype($arg) . " $arg";
                        break;
                    case 'array':
                        $argColor = "orange";
                        $argStr = gettype($arg) . " [...]";
                        break;
                    case 'object':
                        $argColor = "orange";
                        $argStr = gettype($arg) . " of " . get_class($arg);
                        break;
                    case 'resource':
                        $argColor = "orange";
                        $argStr = gettype($arg) . " of " . get_resource_type($arg);
                        break;
                    case 'boolean':
                        $argColor = "blueviolet";
                        $argStr = ($arg) ? gettype($arg) . " TRUE" : gettype($arg) . " FALSE";
                        break;
                    default:
                        $argStr = gettype($arg);
                        $argColor = "";
                        break;
                }
                $arguments[] = "<span style=\"color:{$argColor}\">" . $argStr . "</span>";
            }
        }

        /* String for call with args */
        if (isset($trace['class'])) {
            $asString = $trace['class'] . $trace['type'] . $trace['function'] . "(" . implode(", ", $arguments) . ")";
        } else {
            $asString = $trace['function'] . "(" . implode(", ", $arguments) . ")";
        }

        return $asString;
    }

    /**
     * Rendering view by setted template
     *
     * @return void
     */
    #[NoReturn]
    private function render()
    {
        /* Compressing data for template */
        $theme = [
            "name" => $this->getTemplate(),
            "error" => $this->error,
            "backtrace" => $this->backtrace,
            "file" => $this->file,
            "variables" => [
                "GET" => $_GET,
                "POST" => $_POST,
                "COOKIE" => $_COOKIE,
                "SESSION" => $_SESSION,
                "SERVER" => $_SERVER,
            ],
            "settings" => [
                "template" => $this->template,
            ],
        ];

        /* Checking that template is existing */
        if (!file_exists(WEB_CSS . "/view/{$this->template}.css")) {
            $theme['settings']['template'] = "light";
        } elseif (!file_exists(__DIR__ . "/view/{$this->template}.php")) {
            $theme['settings']['template'] = "light";
        }

        if (App::$type == 'tmd') {
            unset($theme['file']);
            unset($theme['variables']);
            unset($theme['settings']);
            foreach ($theme['backtrace'] as $key => $traceitem) {
//                var_dump($traceitem['asString']);
                $theme['backtrace'][$key] = strip_tags($traceitem['asString']);
            }
            App::$components->view->renderJSON($theme);
        } else {
            App::$components->view->render("error_handler.{$this->template}", [
                'theme' => $theme,
            ]);
        }
    }

    /** Getter for template setting */
    public function getTemplate()
    {
        return $this->template;
    }

    /** Setter for template setting
     *
     * @param $value string Template name
     */
    public function setTemplate(string $value)
    {
        $this->template = $value;
    }

    /**
     * Exception handler
     *
     * @param Throwable $e instance of Exception
     *
     * @return void
     */
    public function catchException(Throwable $e)
    {
        /* Setting params */
        $this->error = [
            "code" => $e->getCode(),
            "type" => get_class($e),
            "level" => '6',
            "message" => $e->getMessage(),
        ];
        $this->file = [
            "name" => $e->getFile(),
            "line" => $e->getLine(),
        ];
        $this->backtrace = $e->getTrace();
        if ($this->traceDepth > 0) {
            $this->backtrace = array_slice($this->backtrace, 0, $this->traceDepth);
        }

        /* Fix for Exception Traces */
        array_unshift($this->backtrace, [
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "asString" => "Throw new {$this->error['type']}(\"{$this->error['message']}\", {$this->error['code']})",
        ]);

        /* Get part of code for each trace step */
        foreach ($this->backtrace as $index => $step) {
            if (!isset($step['file']) or !isset($step['line'])) {
                unset($this->backtrace[$index]);
                continue;
            }
            $this->file["preview"][] = $this->getFileLines($step['file'], $step['line']);
            if (!isset($step['asString'])) {
                $this->backtrace[$index]['asString'] = $this->getAsStringTrace($step);
            }
        }

        $this->render();
    }

    /** Getter for trace depth */
    public function getTraceDepth()
    {
        return $this->traceDepth;
    }

    /**  Setter for trace depth
     *
     * @param $value integer Trace depth, 0 is infinity
     *
     * @return void
     */
    public function setTraceDepth(int $value)
    {
        $this->traceDepth = $value;
    }
}
