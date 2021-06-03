<?php

include_once __DIR__."/../autoloader.php";

use core\services\Config;
use core\services\Log;
use Tritonium\Services\Core;
use Tritonium\Model\Migrations;

if (!Core::isInstalled()){
	Core::consolePrint("Tritonium is not installed yet! Please, install with core/commands/install.php.", "e", TRUE);
}

$migrationFiles = scandir(__DIR__ . "/../migrations");
unset($migrationFiles['0']);
unset($migrationFiles['1']);

$connection = Core::getPDO();

foreach ($migrationFiles as $filename) {
	Core::consolePrint("Processing migration \"{$filename}\".", "i");
	if ($migration = Migrations::findBy(['filename' => $filename])){
		$migration = $migration[0];

		if ($migration['status'] == Migrations::STATUS_READY){
			Core::consolePrint("Migration \"{$filename}\" already created.", "e");
			continue;
		}
	}

	preg_match_all('/(\d{4})_(\d{2})_(\d{2})_(\d{2})(\d{2})(\d{2})_(.*)_(.*)_table\.sql/mU', $filename, $matches, PREG_SET_ORDER, 0);

	$info = [
		"year"      => $matches[0][1],
		"month"     => $matches[0][2],
		"day"       => $matches[0][3],
		"hour"      => $matches[0][4],
		"minute"    => $matches[0][5],
		"sec"       => $matches[0][6],
		"operation" => $matches[0][7],
		"title"     => $matches[0][8],
		"filename"  => $filename
	];

	$info['timestamp'] = strtotime("{$info['day']}.{$info['month']}.{$info['year']} {$info['hour']}:{$info['minute']}:{$info['sec']}");
	$info['datetime'] = date("Y-m-d H:i:s", $info['timestamp']);
	unset($info['year']);
	unset($info['month']);
	unset($info['day']);
	unset($info['hour']);
	unset($info['minute']);
	unset($info['sec']);

	if (empty($migration)) {
		$migrationID = Migrations::create([
			"name"      => $info['title'],
			"status"    => Migrations::STATUS_NOT_CREATED,
			"operation" => $info['operation'],
			"filename"  => $info['filename'],
			"datestamp" => $info['datetime'],
		]);
		$migration = Migrations::first($migrationID);
	}

	$info['content'] = file_get_contents(__DIR__."/../migrations/{$filename}");

	$migration['status'] = Migrations::STATUS_PROCESS;
	Migrations::save($migration);

	try{
		$connection->exec($info['content']);
		Core::consolePrint("Migration \"{$info['filename']}\" created successful.", "i");

		$migration['status'] = Migrations::STATUS_READY;
		Migrations::save($migration);
	}catch (Exception $e){
		$connection->rollBack();
		Core::consolePrint("Error with migration \"{$filename}\": ".$e->getMessage(), "e");

		$migration['status'] = Migrations::STATUS_ERROR;
		Migrations::save($migration);
	}
}