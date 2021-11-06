<?php

namespace Tritonium\App\Controllers;

use Tritonium\App\Base\BaseController;

class DefaultController extends BaseController
{
	public function actionIndex(){
		var_dump("Some logic!");
	}
}