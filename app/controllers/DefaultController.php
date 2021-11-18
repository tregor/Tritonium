<?php

namespace Tritonium\App\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\Core;

class DefaultController extends BaseController
{
	public function actionIndex(){
		var_dump("Some logic!");
	}

	public function actionTest()
	{
		$request = Core::$request;

		var_dump(json_decode($request->body()));
	}
}