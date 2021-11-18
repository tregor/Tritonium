<?php

namespace Tritonium\App\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Core;
use Tritonium\Base\Models\Migrations;

class DefaultController extends BaseController
{
	public function actionIndex(){
		var_dump(Core::getInstallation());
	}

	public function actionTest()
	{
		$database = Core::$components->db;

		var_dump([
			$database,
		]);
	}

	public function actionMigrations()
	{
		$migrations = Migrations::all();

		var_dump($migrations);
	}
}