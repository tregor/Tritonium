<?php

namespace Tritonium\Base\Models;

use Tritonium\Base\App;
use Tritonium\Base\Services\ActiveQuery;
use Tritonium\Base\BaseClass;
use PDOException;

class ActiveModel extends BaseClass
{
	protected $connect;
	protected $table;
	protected $key;
	protected $attributes = [];
	protected $props = [];
	protected $isNewRecord = true;
	
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
	
	public function __toArray(): array {
		return $this->props;
	}
	
	public function getTable() {
		return $this->table;
	}
	
	public static function find(): ActiveQuery {
		$model      = new static;
		$modelclass = get_class($model);
		
		$query = new ActiveQuery($modelclass);
		$query = $query->select('*')->from($model->getTable());
		
		return $query;
	}
	public static function byID($id): ActiveModel {
		$model      = new static;
		return $model->find()->where($model->getKey(), '=', $id)->one();
	}
	
	public function __set($name, $value): void {
		if (in_array($name, $this->attributes)) {
			$this->props[$name] = $value;
		}
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
				
				$model_id = $this->connect->lastInsertId();
				$this->isNewRecord = false;
				$this->props = $this->byID($model_id)->__toArray();
				
				return $model_id;
			} catch (PDOException $e) {
				$this->connect->rollback();
				
				return FALSE;
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
				
				$model_id = $this->connect->lastInsertId();
				
				return $model_id;
			} catch (PDOException $e) {
				$this->connect->rollback();
				
				return "Error" . $e->getMessage();
			}
		}
	}
	
	public function delete(): bool{
		$sql = 'DELETE FROM `' . $this->getTable() . '` WHERE ' . $this->getKey() . ' = ?';
		$stmt = $this->connect->prepare($sql);
		return ($stmt->execute([$this->getKeyValue()]));
	}
	
	/**
	 * @deprecated
	 * @return array
	 */
	public static function all(){
		return self::find()->all(TRUE);
	}
	public function getAttributes(): array{
		return $this->attributes;
	}
	public function getKey(): string{
		return $this->key;
	}
	public function getKeyValue(): string{
		return $this->props[$this->key];
	}
	public function getID(): int{
		return $this->getKeyValue();
	}
	public static function getLabel($key){
		return $key;
	}
}