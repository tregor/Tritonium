<?php

namespace Tritonium\Base\Services;

class PDO extends BaseService
{
	protected $type 	= NULL;
	protected $host		= NULL;
	protected $name		= NULL;
	protected $user 	= NULL;
	protected $pass 	= NULL;
	protected $instance = NULL;

	public function __construct($data = NULL)
	{
		parent::__construct($data);
		return $this->instance();
	}

	public function instance(): \PDO
	{
		if ($this->instance == NULL) { // Breakpoint
			$this->instance = new \PDO(
				"{$this->type}:host={$this->host};dbname={$this->name}", $this->user, $this->pass,
				[\PDO::ATTR_PERSISTENT => TRUE]
			);
			$this->instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->instance->exec("SET CHARACTER SET utf8");
		}

		return $this->instance;
	}

	public function sql($string = NULL): \PDOStatement
	{
		return $this->instance()->query($string);
	}
}