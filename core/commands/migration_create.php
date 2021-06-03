<?php

include_once __DIR__."/../autoloader.php";

use core\services\Config;
use core\services\Log;
use Tritonium\Services\Core;
use Tritonium\Model\Migrations;

$operation = "create";
Core::consolePrint("Select an operation:", "i");
Core::consolePrint("    [1] Create", "i");
Core::consolePrint("    [2] Update", "i");
Core::consolePrint("    [3] Delete", "i");
switch (readline("Select an operation: ")){
	case "1":
		$operation = "create";
		break;
	case "2":
		$operation = "update";
		break;
	case "3":
		$operation = "delete";
		break;
	default:
		Core::consolePrint("Bye-bye!", "s", TRUE);
		break;
}
$tableName = strtolower(readline("Enter table name: "));

Core::consolePrint("Generating blank migration file...", "i");
$filename = date("Y_m_d_His")."_{$operation}_{$tableName}_table.sql";

if ($operation === "create"){
	$content = <<<SQL
CREATE TABLE `{$tableName}`
(
	`id`         int      NOT NULL AUTO_INCREMENT,
	`param`      text,
	`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`update_at`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);
SQL;
}

if ($operation === "update"){
	$content = <<<SQL
ALTER TABLE `{$tableName}`
	ADD `column_name` text;

ALTER TABLE `{$tableName}`
	DROP COLUMN `column_name`;

ALTER TABLE `{$tableName}`
	ALTER COLUMN `column_name` text;
SQL;
}

if ($operation === "delete"){
	$content = <<<SQL
DROP TABLE `{$tableName}`;
SQL;
}

Core::consolePrint("Saving migration file...", "i");
file_put_contents(ROOT."core/migrations/".$filename, $content);

Core::consolePrint("Migration \"{$filename}\" created successfully!", "s");