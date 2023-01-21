<?php

namespace Tritonium\Base\Models;

use Tritonium\Base\App;
use Tritonium\Base\Services\ActiveQuery;
use Tritonium\Base\Services\Config;
use Tritonium\Base\BaseClass;
use Exception;
use PDOException;


/**
 * $user = new User();
 * $user->name = 'Vasya';
 * $user->save();
 *
 * $user->find(1);
 * $user->delete();
 *
 * $user->find()->where('active', '=', 1)->all();
 * $user->find()->where('active', '=', 1)->andWhere('id', '>', 1)->orderBy('id')->sort('ASC')->limit(5)->all(); //LAST 5 RECORDS
 * $user->find()->all();
 * $user->find()->where('active', '=', 1)->one();
 * $user->find()->where('active', '=', 1)->count();
 *
 */
class ActiveModel extends BaseClass
{
	protected $connect;
	protected $table;
	protected $key;
	protected $attributes = [];
	protected $props = [];
	/* @deprecated */
	protected $secured;
	/* @deprecated */
	protected $labels;
	private $isNewRecord = true;
	
	public function __construct($isNew = true) {
		$this->connect     = App::$components->db;
		$this->isNewRecord = $isNew;
		
		$rs = $this->connect->query('SELECT * FROM ' . $this->getTable() . ' LIMIT 0');
		for ($i = 0; $i < $rs->columnCount(); $i++) {
			$col                = $rs->getColumnMeta($i);
			$this->attributes[] = $col['name'];
		}
		
		$rs        = $this->connect->query('SHOW KEYS FROM ' . $this->getTable() . ' WHERE Key_name = \'PRIMARY\';');
		$this->key = $rs->fetchColumn(4);
	}
	
	public function getTable() {
		return $this->table;
	}
	
	public static function find(): ActiveQuery {
		$model      = new static;
		$modelclass = get_class($model);
//		var_dump($modelclass);
		
		$query = new ActiveQuery($modelclass);
		$query = $query->select('*')->from($model->getTable());
		
		return $query;
	}
	
	public function __set($name, $value): void {
		if (in_array($name, $this->attributes)) {
			$this->props[$name] = $value;
		}
		//		parent::__set($name, $value);
	}
	
	public function __get($name) {
		if (isset($this->props[$name])) {
			return $this->props[$name];
		}
	}
	
	public function save() {
		$attributes = array_flip($this->attributes);
		$data       = array_filter($this->props, function ($prop) use ($attributes) {
			return isset($attributes[$prop]);
		}, ARRAY_FILTER_USE_KEY);
		
		if ($this->isNewRecord) {
			$sql = "INSERT INTO `{$this->getTable()}` (";
			
			foreach ($data as $key => $value) {
				$sql .= "`{$key}`, ";
			}
			$sql = trim($sql, ', ');
			$sql .= ") VALUES (";
			foreach ($data as $key => $value) {
				$sql .= ":{$key}, ";
			}
			$sql = trim($sql, ', ');
			$sql .= ")";
			
			$statement = $this->connect->prepare($sql);
			foreach ($data as $key => $value) {
				$statement->bindValue(':' . $key, $value);
			}
			
			try {
				$statement->execute();
				
				return $this->connect->lastInsertId();
			} catch (PDOException $e) {
				$this->connect->rollback();
				
				return "Error" . $e->getMessage();
			}
		} else {
			//Saving updated record
			$sql         = "UPDATE `{$this->getTable()}` SET ";
			$primary_key = $data[$this->key];
			unset($data[$this->key]);
			//TODO unset secured fields here
			
			foreach ($data as $key => $value) {
				$sql .= "`{$key}` = :{$key}, ";
			}
			$sql = trim($sql, ', ');
			$sql .= ' WHERE `' . $this->key . '` = :' . $this->key;
			
			
			$statement = $this->connect->prepare($sql);
			foreach ($data as $key => $value) {
				$statement->bindValue(':' . $key, $value);
			}
			$statement->bindValue(':' . $this->key, $primary_key);
			
			try {
				$statement->execute();
				$statement->debugDumpParams();
				
				return $this->connect->lastInsertId();
			} catch (PDOException $e) {
				$this->connect->rollback();
				
				return "Error" . $e->getMessage();
			}
		}
	}
	
	public function getKey(){
		return $this->key;
	}
	
	public function getKeyValue(){
		return $this->props[$this->key];
	}
	
	public function delete(){
		$sql = 'DELETE FROM `' . $this->getTable() . '` WHERE ' . $this->getKey() . ' = ?';
//		var_dump($sql.$this->getKeyValue());
		$stmt = $this->connect->prepare($sql);
		return ($stmt->execute([$this->getKeyValue()]));
	}
}