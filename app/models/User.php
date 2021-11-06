<?php

namespace Tritonium\Model;

use Tritonium\core\AlphaModel;

class User extends AlphaModel {

	/**
	 * @var string Table in which model's data is stored
	 */
	protected $table = 'users';

	/**
	 * @var string Primary key, default is "ID"
	 */
	protected $key = 'user_id';

	/**
	 * @var string[] List of attributes we will have access
	 */
	protected $attributes = [
		'user_id',
		'login',
		'password',
		'token'
	];
}