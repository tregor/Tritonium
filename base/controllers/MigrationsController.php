<?php

namespace Tritonium\Base\Controllers;

use Tritonium\Base\Controllers\BaseController;
use Tritonium\Base\Services\Console;
use Tritonium\Base\Services\Config;
use Tritonium\Base\Services\Log;
use Tritonium\Base\App;
use Tritonium\Base\Models\Migrations;

class MigrationsController extends BaseController
{
	public function actionCreate()
	{
		Console::info("Select an operation:");
		Console::info("    [1] Create");
		Console::info("    [2] Update");
		Console::info("    [3] Delete");
		switch (Console::input("Select an operation: ")){
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
				Console::success("Bye-bye!");
				exit;
		}
		$tableName = strtolower(Console::input("Enter table name: "));

		Console::info("Generating blank migration file...");
		$filename = date("Y_m_d_His")."_{$operation}_{$tableName}_table.sql";

		if ($operation === "create"){
			$content = <<<SQL
		CREATE TABLE `{$tableName}`
		(
			`id`         int      NOT NULL AUTO_INCREMENT,
			`param`      text,
			`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`updated_at`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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

		Console::info("Saving migration file...");
		file_put_contents(DIR_APP . "migrations/".$filename, $content);

		Console::success("Migration \"{$filename}\" created successfully!");
	}

	public function actionMigrate()
	{
		$migrationFiles = scandir(DIR_APP . "migrations/");
		unset($migrationFiles['0']);
		unset($migrationFiles['1']);

		$connection = App::$components->db;

		foreach ($migrationFiles as $filename) {
			Console::print("Processing migration \"{$filename}\".", "i");
			if ($migration = Migrations::findBy(['filename' => $filename])){
				$migration = $migration[0];

				if ($migration['status'] == Migrations::STATUS_READY){
					Console::print("Migration \"{$filename}\" already created.", "e");
					continue;
				}
			}

			$mask = preg_match_all('/(\d{4})_(\d{2})_(\d{2})_(\d{2})(\d{2})(\d{2})_(.*)_(.*)_table\.sql/mU', $filename, $matches, PREG_SET_ORDER, 0);
			if (!$mask) continue;
			
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

			$info['content'] = file_get_contents(DIR_APP . "migrations/{$filename}");

			$migration['status'] = Migrations::STATUS_PROCESS;
			Migrations::save($migration);

			try{
				$connection->exec($info['content']);
				$migration['status'] = Migrations::STATUS_READY;
				Migrations::save($migration);

				Console::print("Migration \"{$info['filename']}\" created successful.", "i");
			}catch (\Exception $e){
				if ($connection->inTransaction()){
					$connection->rollBack();
				}
				Console::print("Error with migration \"{$filename}\": ".$e->getMessage(), "e");

				$migration['status'] = Migrations::STATUS_ERROR;
				Migrations::save($migration);
			}
		}
	}

	public function actionDrop()
	{
		switch (Console::input("This will drop all tables, confirm? (Y/n): ")){
			case "Y":
				break;
			default:
				Console::success("Bye-bye!", TRUE);
				exit;
		}

		$db = App::$components->db;
		$tables = Migrations::all();
		foreach ($tables as $table) {
			if (strlen($table['name']) == 0) continue;
			Console::info("Droping table '{$table['name']}'...");
			$sql = "DROP TABLE `{$table['name']}`";
			$db->prepare($sql)->execute();
			$table['status'] = Migrations::STATUS_DELETED;
			Migrations::save($table);
		}

		Console::success("All migrations reverted!");
	}

	public function actionTruncate()
	{
		switch (Console::input("This will clean all tables, confirm? (Y/n): ")){
			case "Y":
				break;
			default:
				Console::success("Bye-bye!", TRUE);
				exit;
		}

		$db = App::$components->db;
		$tables = Migrations::all();
		foreach ($tables as $id => $table) {
			Console::info("Truncating table '{$table['name']}'...");
			$sql = "TRUNCATE TABLE `{$table['name']}`";
			$db->prepare($sql)->execute();
		}

		Console::success("All tables cleared!");
	}
	
	public function actionRollback(){
		$db = App::$components->db;
		$table = array_reverse(Migrations::all())[0];
		var_dump($table);
		
		//TODO Improve to read migration and rollback with action like rollback UPDATE()
		$dump_file = $this->dumpTableFile($table['name'], 'WeedExpress');
		Console::info("Dropping table '{$table['name']}'...");
		Console::info("Dump saved on  '{$dump_file}'.");
		$sql = "DROP TABLE `{$table['name']}`";
		$db->prepare($sql)->execute();
		
		Migrations::delete($table['id']);
	}
	
	private function dumpTableFile($table, $db_name = ''){
		$db_user = 'mysqladmin';
		$db_pass = '9hIbduu6YBtL';
		
		$sql_file = DIR_LOGS.'/sql/'.time().'_'.$db_name.'.'.$table.'.dump.sql';
		$command = "mysqldump --opt --default-character-set=UTF8 --single-transaction --protocol=TCP --user={$db_user} --password={$db_pass} {$db_name} > {$sql_file}";
		shell_exec($command);
		
		return $sql_file;
	}
}