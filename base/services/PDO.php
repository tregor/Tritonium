<?php

namespace Tritonium\Base\Services;

class PDO extends \PDO
{
	protected $dsn		= NULL;
	protected $user 	= NULL;
	protected $pass 	= NULL;

	public function __construct($data = NULL)
	{
		$this->dsn = "{$data['type']}:host={$data['host']};dbname={$data['name']}";
		$this->user = $data['user'];
		$this->pass = $data['pass'];

		parent::__construct($this->dsn, $this->user, $this->pass,[\PDO::ATTR_PERSISTENT => TRUE]);
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->exec("SET CHARACTER SET utf8");
	}
}