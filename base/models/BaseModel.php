<?php

namespace Tritonium\Base\Models;

use Tritonium\Base\Core;
use Tritonium\Base\Services\Config;
use Exception;
use PDO;
use PDOException;

class BaseModel
{

	protected $connect;
	protected $key = "ID";

	public function __construct()
	{
		$database = Core::$components->db;
		$this->connect = $database->instance();
	}

	static public function all()
	{
		$model = new static;

		return $model->execute('SELECT * FROM ' . $model->table);
	}

	protected function execute($sql, $params = [])
	{
		$attributes = array_flip($this->attributes);
		$result = [];
		$statement = $this->connect->prepare($sql);
		$statement->execute($params);
		foreach ($statement as $row) {
			$result[] = array_filter($row, function ($data) use ($attributes) {
				return isset($attributes[$data]);
			}, ARRAY_FILTER_USE_KEY);
		}

		return $result;
	}

	static public function find($value, $key = FALSE)
	{
		$model = new static;
		if (!$key) {
			$key = $model->key;
		}

		return $model->execute('SELECT * FROM ' . $model->table . ' WHERE ' . $key . ' = ?', [$value]);
	}

	static public function findOrFail($value, $key = FALSE){
		$result = self::find($value, $key);
		if (empty($result) OR !is_array($result)){
			throw new Exception(self::class." not found");
		}

		return $result;
	}

	static public function first($value, $key = FALSE){
		return self::find($value, $key)[0];
	}

	static public function firstOrFail($value, $key = FALSE){
		return self::findOrFail($value, $key)[0];
	}

	static public function findBy($data)
	{
		$model = new static;
		$sql = 'SELECT * FROM ' . $model->table . ' WHERE ';
		$values = [];
		foreach ($data as $key => $value) {
			$sql .= $key . ' = ? AND ';
			$values[] = $value;
		}
		$sql = trim($sql, ' AND ');

		return $model->execute($sql, $values);
	}

	static public function findByOrFail($data){
		$result = self::findBy($data);
		if (empty($result) OR !is_array($result)){
			throw new Exception(self::class." not found");
		}

		return $result;
	}

	static public function save($data)
	{
		try {
			$model = new static;
			$attributes = array_flip($model->attributes);
			$data = array_filter($data, function ($data) use ($attributes) {
				return isset($attributes[$data]);
			}, ARRAY_FILTER_USE_KEY);

			$sql = 'UPDATE ' . $model->table . ' SET ';
			if (empty($data[$model->key])) {
				throw new Exception('Not found primary key');
			}
			$primary_key = $data[$model->key];
			unset($data[$model->key]);
			foreach ($data as $key => $value) {
				$sql .= '' . $key . ' = :' . $key . ', ';
			}
			$sql = trim($sql, ', ');
			$sql .= ' WHERE ' . $model->key . ' = :' . $model->key;
			$statement = $model->connect->prepare($sql);
			foreach ($data as $column => $value) {
				$statement->bindValue(':' . $column, $value);
			}
			$statement->bindValue(':' . $model->key, $primary_key);
			try {
				$statement->execute();

				return $model->connect->lastInsertId();
			} catch (PDOException $e) {
				$model->connect->rollback();

				return "Error" . $e->getMessage();
			}
		} catch (PDOException $e) {
			return "Error" . $e->getMessage();
		}
	}

	static public function create($data)
	{
		try {
			$model = new static;
			$attributes = array_flip($model->attributes);
			$data = array_filter($data, function ($data) use ($attributes) {
				return isset($attributes[$data]);
			}, ARRAY_FILTER_USE_KEY);
			$sql = 'INSERT INTO ' . $model->table . ' (';
			foreach ($data as $column => $value) {
				$sql .= '`' . $column . '`, ';
			}
			$sql = trim($sql, ', ');
			$sql .= ') VALUES (';
			foreach ($data as $column => $value) {
				$sql .= ':' . $column . ', ';
			}
			$sql = trim($sql, ', ');
			$sql .= ')';
			$statement = $model->connect->prepare($sql);
			foreach ($data as $column => $value) {
				$statement->bindValue(':' . $column, $value);
			}
			try {
				$statement->execute();

				return $model->connect->lastInsertId();
			} catch (PDOException $e) {
				$model->connect->rollback();

				return "Error" . $e->getMessage();
			}
		} catch (PDOException $e) {
			return "Error" . $e->getMessage();
		}
	}

}