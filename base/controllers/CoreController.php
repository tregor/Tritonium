<?php

namespace Tritonium\Base\Controllers;

use Tritonium\Base\App;
use Tritonium\Base\Services\Console;


class CoreController extends BaseController
{
    public function actionInstall()
    {
        // if (App::isInstalled()){
        // 	//TODO: Функционал детекции перустановки с консольным UI
        // 	Console::warning("Tritonium is already installed! Do you want to reinstall it? (Y/n).");
        // 	if (strtolower(Console::input("Do you want to reinstall Tritonium? (Y/n) ")) !== "y"){
        // 		Console::info("Bye-bye!", TRUE);
        // 	}
        // }

        $installationData = [
            "needInstall" => true,
            "needUpdate" => false,
            "needReinstall" => false,
            "info" => [
                "timestamp" => time(),
                "installationDate" => date("d.m.Y H:i:s"),
                "path" => __DIR__ . "/../../",
                "user" => posix_getpwuid(posix_geteuid()),
                "owner" => get_current_user(),
            ],
            "modules" => [
                "Migrations" => false,
            ],
        ];


        Console::info("Starting Tritonium installation...");


        // /**
        //  * Start of installation module Migrations
        //  */
        // Console::info("Please, check current PDO settings below:");
        // Console::print("PDO_TYPE: ".Config::get("PDO_TYPE"));
        // Console::print("PDO_HOST: ".Config::get("PDO_HOST"));
        // Console::print("PDO_NAME: ".Config::get("PDO_NAME"));
        // Console::print("PDO_USER: ".Config::get("PDO_USER"));
        // Console::print("PDO_PASS: ".Config::get("PDO_PASS"));
        // if (strtolower(Console::input("Continue? (Y/n) ")) !== "y"){
        // 	//TODO: Input for each field
        // 	Console::info("Bye-bye!", TRUE);
        // }

        $connection = App::$components->db;
        if (!$connection) {
            Console::error("Error while initializing PDO Connection!", true);
        } else {
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
        if ($connection->exec($sql) === false) {
            Console::error("Error while creating table 'migrations!'", true);
        } else {
            Console::success("Table 'migrations' successfully created!");
            $installationData['modules']['Migrations'] = true;
        }
        /**
         * End of installation module Migrations
         */

        $installationData['needInstall'] = false;
        file_put_contents(DIR_ROOT . 'installation.json', json_encode($installationData, JSON_PRETTY_PRINT));
        Console::info("Installation finished!");
    }

    public function actionNginx()
    {
        $serverName = App::$config->app->server;
        $rootDir = "/var/www/{$serverName}/web/";
        $logAccess = "{$rootDir}../logs/access.log";
        $logError = "{$rootDir}../logs/error.log";

        $config = <<<NGINX
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80;
    listen [::]:80;

    root {$rootDir};
    index index.php;

    access_log {$logAccess};
    error_log {$logAccess};

    server_name {$serverName};

    location / {
        try_files \$uri \$uri/ /index.php?\$args;
    }

    location ~ \\.php\$ {
        include snippets/fastcgi-php.conf;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
    }

    location ~ /\.(ht|svn|git) {
        deny all;
    }
}
NGINX;

        file_put_contents("/etc/nginx/sites/{$serverName}", $config);
    }
}
