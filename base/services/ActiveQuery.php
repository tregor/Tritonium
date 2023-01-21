<?php

namespace Tritonium\Base\Services;

use PDO;
use Tritonium\Base\App;
use Tritonium\Base\Services\Config;
use Tritonium\Base\BaseClass;
use Exception;
use PDOException;

class ActiveQuery extends BaseClass
{
	/**
	 * @var array<string>
	 */
	private $fields = [];
	
	/**
	 * @var array<string>
	 */
	private $conditions = [];
	
	/**
	 * @var array<string>
	 */
	private $from = [];
	
	private $orderBy = '';
	private $sortBy = 'ASC';
	private $limitBy = -1;
	private $offsetBy = -1;
	private $bindParams = [];
	
	private $connect;
	private $modelclass;
	
	public function __construct($modelclass = null) {
		$this->modelclass = $modelclass;
		$this->connect    = App::$components->db;
	}
	
	public function select(string ...$select): self {
		$this->fields = $select;
		
		return $this;
	}
	
	public function where($col, $oper, $val): self {
		if (is_string($val)) {
			$val = '"' . $val . '"';
		}
		if ($val === null) {
			$val = 'NULL';
		}
		$this->conditions[] = trim($col) . ' ' . trim($oper) . ' ' . trim($val);
		
		return $this;
	}
	
	public function from(string $table, ?string $alias = null): self {
		if ($alias === null) {
			$this->from[] = $table;
		} else {
			$this->from[] = "${table} AS ${alias}";
		}
		
		return $this;
	}
	
	public function orderBy(string $column): self {
		$this->orderBy = trim($column);
		
		return $this;
	}
	
	public function sort(string $sort) {
		if (strtoupper($sort) !== 'ASC') {
			$this->sortBy = 'DESC';
		}
		
		return $this;
	}
	
	public function limit(int $limit) {
		if ($limit != 0) {
			$this->limitBy = $limit;
		}
		
		return $this;
	}
	
	public function offset(int $offset) {
		if ($offset != 0) {
			$this->offsetBy = $offset;
		}
		
		return $this;
	}
	
	public function count() {
		return count($this->execute());
	}
	
	private function execute() {
		$sql       = $this->__toString();
		$statement = $this->connect->prepare($sql);
		$statement->execute();
		
		if ($this->modelclass == null) {
			$result = [];
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $row;
			}
		} else {
			$result = $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->modelclass, [false]);
		}
		
		return $result;
	}
	
	public function __toString(): string {
		$sql_select  = implode(', ', $this->fields);
		$sql_from    = implode(', ', $this->from);
		$sql_where   = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
		$sql_orderBy = $this->orderBy === '' ? '' : ' ORDER BY ' . $this->orderBy . ' ' . $this->sortBy;
		$sql_limit   = ($this->limitBy != -1) ? ' LIMIT ' . $this->limitBy : '';
		$sql_offset   = ($this->offsetBy != -1) ? ' OFFSET ' . $this->offsetBy : '';
		
		$sql = "SELECT {$sql_select} FROM {$sql_from}{$sql_where}{$sql_orderBy}{$sql_limit}{$sql_offset}";
		return trim($sql) . ';';
	}
	
	public function all() {
		return $this->execute();
	}
	
	public function one() {
		return $this->execute()[0];
	}
	
	public function exist() {
		return (count($this->execute()) > 0);
	}
}