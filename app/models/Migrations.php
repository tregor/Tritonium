<?php

namespace Tritonium\Model;

use Tritonium\core\AlphaModel;

class Migrations extends AlphaModel
{
	const STATUS_NOT_CREATED = 0;
	const STATUS_READY       = 1;
	const STATUS_PROCESS     = 2;
	const STATUS_ERROR       = 3;

	/**
	 * @var string Table in which model's data is stored
	 */
	protected $table = 'migrations';

	/**
	 * @var string Primary key, default is "ID"
	 */
	protected $key = 'id';

	/**
	 * @var string[] List of attributes we will have access
	 */
	protected $attributes
		= [
			'id',
			'name',
			'status',
			'operation',
			'filename',
			'datestamp',
		];
}