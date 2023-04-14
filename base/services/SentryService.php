<?php

namespace Tritonium\Base\Services;

use Sentry\Severity;
use Sentry\State\Scope;

use function Sentry\captureMessage;
use function Sentry\init;
use function Sentry\withScope;


class SentryService
{
    private $dsn;
    private $level = E_ALL;
    private $defaults = TRUE;

    public function __construct($data = NULL) {
        $this->dsn      = $data['dsn'];
        $this->level    = $data['level'];
        $this->defaults = $data['defaults'];

        init([
            'dsn'                  => $this->dsn,
            'error_types'          => $this->level,
            'default_integrations' => $this->defaults,
        ]);
    }

    public static function debug(string $message, $data = NULL) {
        self::log($message, $data, 'debug');
    }

    public static function error(string $message, $data = NULL) {
        self::log($message, $data, 'error');
    }

    public static function fatal(string $message, $data = NULL) {
        self::log($message, $data, 'fatal');
    }

    public static function info(string $message, $data = NULL) {
        self::log($message, $data, 'info');
    }

    public static function log(string $message, $data = NULL, $level = 'info') {
        withScope(function (Scope $scope) use ($message, $data, $level): void {
            $scope->setLevel(Severity::$level());
            if ( ! empty($data)) {
                if (is_object($data)) {
                    $data = $data->__toArray();
                }
                if ( ! is_array($data)) {
                    $data = ['data' => $data];
                }
                foreach ($data as $key => $value) {
                    $scope->setContext($key, $value);
                }
            }

            captureMessage($message);
        });
    }

    public static function warning(string $message, $data = NULL) {
        self::log($message, $data, 'warning');
    }
}