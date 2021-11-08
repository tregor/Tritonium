<?php

namespace Tritonium\Base\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Services\Config;
use Tritonium\Base\Services\Log;
use Tritonium\Base\Services\Core;
use Tritonium\Base\Services\Console;

class CoreController extends BaseController
{
	public function actionInstall(){
		if (Core::isInstalled()){
			//TODO: Функционал детекции перустановки с консольным UI
			Console::warning("Tritonium is already installed! Do you want to reinstall it? (Y/n).");
			if (strtolower(Console::input("Do you want to reinstall Tritonium? (Y/n) ")) !== "y"){
				Console::info("Bye-bye!", TRUE);
			}
		}

		$installationData = [
			"needInstall" => TRUE,
			"needUpdate" => FALSE,
			"needReinstall" => FALSE,
			"info" => [
				"timestamp" => time(),
				"installationDate" => date("d.m.Y H:i:s"),
				"path" => __DIR__."/../../",
				"user" => posix_getpwuid(posix_geteuid()),
				"owner" => get_current_user(),
			],
			"modules" => [
				"Migrations" => FALSE,
			],
		];


		Console::info("Starting Tritonium installation...");


		/**
		 * Start of installation module Migrations
		 */
		Console::info("Please, check current PDO settings below:");
		Console::print("PDO_TYPE: ".Config::get("PDO_TYPE"));
		Console::print("PDO_HOST: ".Config::get("PDO_HOST"));
		Console::print("PDO_NAME: ".Config::get("PDO_NAME"));
		Console::print("PDO_USER: ".Config::get("PDO_USER"));
		Console::print("PDO_PASS: ".Config::get("PDO_PASS"));
		if (strtolower(Console::input("Continue? (Y/n) ")) !== "y"){
			//TODO: Input for each field
			Console::info("Bye-bye!", TRUE);
		}

		$connection = Core::getPDO();
		if (!$connection){
			Console::error("Error while initializing PDO Connection!", TRUE);
		}else{
			Console::success("Connection to PDO initialized.");
		}

		Console::info("Creating migrations table...");
		$sql = "CREATE TABLE IF NOT EXISTS migrations
		(
			id        int      NOT NULL AUTO_INCREMENT,
			name      text,
			status    int,
			operation text,
			filename  text,
			datestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id)
		);";
		if ($connection->exec($sql) === FALSE){
			Console::error("Error while creating table 'migrations!'", TRUE);
		}else{
			Console::success("Table 'migrations' successfully created!");
			$installationData['modules']['Migrations'] = TRUE;
		}
		/**
		 * End of installation module Migrations
		 */

		$installationData['needInstall'] = FALSE;
		file_put_contents(__DIR__."/../installation.json", json_encode($installationData));
		Console::info("Installation finished!");
	}
}