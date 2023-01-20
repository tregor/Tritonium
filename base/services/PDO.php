<?php

namespace Tritonium\Base\Services;

class PDO extends \PDO
{
	protected $dsn = null;
	
	public function __construct($data = null) {
		$this->dsn = "{$data['type']}:host={$data['host']};dbname={$data['name']}";
		
		parent::__construct($this->dsn, $data['user'], $data['pass'], [\PDO::ATTR_PERSISTENT => true]);
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->exec("SET CHARACTER SET utf8");
	}
}