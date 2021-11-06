<?php

namespace Tritonium\App\Controllers;

use Tritonium\App\Base\BaseController;

class CoreController extends BaseController
{
	public function actionInstall(){
		var_dump("Hello from CoreController!");
		var_dump("Installing!");
	}
}