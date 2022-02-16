<?php

namespace Tritonium\App\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\View;
use Tritonium\App\Services\YelpAPI;
use Tritonium\App\Models\Update;
use Tritonium\App\Models\User;
use Tritonium\App\Models\Task;
use Tritonium\Base\App;
use GuzzleHttp\Client;

class AdminController extends BaseController
{
	protected $beforeExclude = [
		'actionTest',
		'actionLogin',
		'actionSignup',
	];

	public function beforeAction()
	{
		$cookies = App::$components->request->cookies();
		$admin_token = $cookies['admin_token'];
		if (!$admin_token) {
			die('access_denied');
		}

		return TRUE;
	}

	public function actionIndex(){
		App::$components->view->setCode(200)
		->setHeader('Content-Type', 'text/html;charset=UTF8')
		->render('admin.main');
	}

	public function actionLogin()
	{
		$request = App::$components->request;
		if ($request->has('id')) {
			$user = User::first($request->input('id'));
			if ($user) {
				$user_token = hash('md5', $user['id'].$user['role'].$user['tg_id']);
				setcookie('admin_token', $user_token);
			}

			if ($request->method() == "POST") {
				App::$components->view->renderJSON(['admin_token' => $user_token]);
			}else{
				App::$components->view->redirect('/admin/index');
			}
		}

		App::$components->view->render('admin.login');
	}

	public function actionSignup()
	{
		App::$components->view->render('admin.signup');
	}
}