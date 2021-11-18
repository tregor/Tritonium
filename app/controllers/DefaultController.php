<?php

namespace Tritonium\App\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Models\Migrations;
use Tritonium\Base\Services\Console;
use Tritonium\Base\App;
use Tritonium\Base\Exceptions\ControllerException;

class DefaultController extends BaseController
{
	public function actionIndex(){
		var_dump(Console::$args);
	}

	public function actionTest()
	{
		$db = App::$components->db;

		var_dump($db->query("SHOW TABLES;")->fetchAll());
	}

	public function actionMigrations()
	{
		$migrations = Migrations::all();

		var_dump($migrations);
	}
}