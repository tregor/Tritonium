<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\Services\Config;
use PDO;
use Exception;
use Tritonium\Base\Services\Log;

class Core
{
	const INSTALL_LOG_FORMAT = "";

	private static $PDOInstance = NULL;

	public static function isInstalled(){
		if (file_exists(__DIR__."/../installation.json")){
			$infoJson = file_get_contents(__DIR__."/../installation.json");
			$info = json_decode($infoJson, TRUE);

			if ($info['needInstall']){
				return FALSE;
			}
			if ($info['needUpdate']){
				return FALSE;
			}
			if ($info['needReinstall']){
				return FALSE;
			}

			return TRUE;
		}else{
			return FALSE;
		}
	}

	public static function getInstallation(){
		if (self::isInstalled()){
			$infoJson = file_get_contents(__DIR__."/../installation.json");
			$info = json_decode($infoJson, TRUE);

			return $info;
		}

		return FALSE;
	}

	public static function getPDO()
	{
		if (self::$PDOInstance == NULL) {

			$type = Config::get("PDO_TYPE");
			$host = Config::get("PDO_HOST");
			$dbname = Config::get("PDO_NAME");
			$user = Config::get("PDO_USER");
			$password = Config::get("PDO_PASS");

			try {
				self::$PDOInstance = new PDO("{$type}:host={$host};dbname={$dbname}", $user, $password, [PDO::ATTR_PERSISTENT => TRUE]);
				self::$PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$PDOInstance->exec("SET CHARACTER SET utf8");
			} catch (Exception $e) {
				Log::error("Error while creating PDO \"{$type}:host={$host};dbname={$dbname}\" and user:pass is {$user}:{$password}. " . $e->getMessage());
				return FALSE;
			}

		}

		return self::$PDOInstance;
	}

	public static function isDebug()
	{
		return Config::get("TMD_DEBUG");
	}
}