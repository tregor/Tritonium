<?php

namespace Tritonium\App\Controllers;

use Tritonium\App\Models\ActiveUser;
use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Models\Migrations;
use Tritonium\Base\Services\Console;
use Tritonium\Base\App;
use Tritonium\Base\Exceptions\ControllerException;

class DefaultController extends BaseController
{
	public function actionIndex() {
		App::$components->view->setCode(200)->setHeader('Content-Type', 'text/html;charset=UTF8')->render('default');
	}
	
	public function actionTest() {
		$users = ActiveUser::find()->where('token', 'IS', NULL)->all();
		$users = ActiveUser::find()->all();
		var_dump($users);
	}
}