<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\Exceptions\ThreadsException;


class Threads
{
    protected string $phpPath = '/usr/bin/php';
    private int $lastId = 0;
    private array $descriptorSpec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
    ];
    private array $handles = [];
    private array $streams = [];
    private array $results = [];
    private array $pipes = [];
    private int $timeout = 10;

    public static function getParams()
    {
        foreach ($_SERVER['argv'] as $key => $argv) {
            if ($argv == '--params' && isset($_SERVER['argv'][$key + 1])) {
                return unserialize($_SERVER['argv'][$key + 1]);
            }
        }

        return false;
    }

    public function iteration()
    {
        if (!count($this->streams)) {
            return false;
        }
        $read = $this->streams;
        stream_select($read, $write = null, $except = null, $this->timeout);
        $stream = current($read);
        $id = array_search($stream, $this->streams);
        $result = stream_get_contents($this->pipes[$id][1]);
        if (feof($stream)) {
            fclose($this->pipes[$id][0]);
            fclose($this->pipes[$id][1]);
            proc_close($this->handles[$id]);
            unset($this->handles[$id]);
            unset($this->streams[$id]);
            unset($this->pipes[$id]);
        }

        return $result;
    }

    public function newThread($filename, $params = [])
    {
        if (!file_exists($filename)) {
            throw new ThreadsException('FILE_NOT_FOUND');
        }

        $params = addcslashes(serialize($params), '"');
        $command = $this->phpPath . ' -q ' . $filename . ' --params "' . $params . '"';
        ++$this->lastId;

        $this->handles[$this->lastId] = proc_open($command, $this->descriptorSpec, $pipes);
        $this->streams[$this->lastId] = $pipes[1];
        $this->pipes[$this->lastId] = $pipes;

        return $this->lastId;
    }
}
