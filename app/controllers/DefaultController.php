<?php

namespace Tritonium\App\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Services\Console;

class DefaultController extends BaseController
{
	public function actionIndex(){
		var_dump("Some logic!");
	}

	public function actionTest()
	{
		Console::info("Sam test");
	}
}