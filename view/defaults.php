<?php

use core\services\Template;
use core\services\Config;

Template::setDefaults([
	"demo" => FALSE,
	"siteTitle" => "Управление ботом",
	"sidebar" => [
		"title"   => "Уведомления",
		"content" => "Уведомлений нет",
	],
	"footer" => [
		"copyright" => '<strong>Copyright &copy; 2021-'.date("Y").' <a href="https://t.me/tregor">by tregor</a>.</strong> All rights reserved.',
		"message" => ""
	],
	"menu" => [
		[
			"name" => "Главная",
			"href" => Config::get("SITE_ROOT")."admin/",
		],
		[
			"name" => "Пользователи",
			"href" => Config::get("SITE_ROOT")."admin/users/",
		],
		[
			"name" => "Подписки",
			"href" => Config::get("SITE_ROOT")."admin/subscriptions/",
		],
		[
			"name" => "Уроки",
			"href" => Config::get("SITE_ROOT")."admin/lessons/",
		],
		[
			"name" => "Updates",
			"href" => Config::get("SITE_ROOT")."admin/updates/",
		],
	]
]);