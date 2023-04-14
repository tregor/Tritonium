<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\App;


class PDO extends \PDO
{
    protected ?string $dsn = null;

    public function __construct($data = null)
    {
        try {
            $this->dsn = "{$data['type']}:host={$data['host']};dbname={$data['name']}";

            parent::__construct($this->dsn, $data['user'], $data['pass'], [\PDO::ATTR_PERSISTENT => true]);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->exec("SET CHARACTER SET utf8");
        } catch (\PDOException $exception) {
            App::$components->sentry->error('PDOException', $exception);
        }
    }

    public function exec(string $statement): int|false
    {
        try {
            $result = parent::exec($statement);
        } catch (\PDOException $exception) {
            switch ($exception->getCode()) {
                case 2006:
                case 1053:
                    //MySQL server is going to sleep
                    break;
            }
        }

        return $result;
    }
}
