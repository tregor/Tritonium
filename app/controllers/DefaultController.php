<?php

namespace Tritonium\App\Controllers;

use Tritonium\App\Models\ActiveUser;
use Tritonium\Base\BaseEvent;
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
	
	public function actionTestActiveModels() {
		$users = ActiveUser::find()->where('token', 'IS', NULL)->all();
		$users = ActiveUser::find()->all();
		var_dump($users);
	}
	
	public function actionTestEvents() {
		$this->on('messageSend', function (BaseEvent $event) {
			var_dump($event->getData());
		});
		$this->trigger('messageSend', 'test1');
		
		$this->on('messageSend', 'var_dump');
		$this->trigger('messageSend', ['test2' => TRUE]);
		
		$this->on('messageSend', [$this, 'messageReceived']);
		$this->trigger('messageSend', new \StdClass);
	}
	
	public function messageReceived(){
		echo('message received!');
	}
}