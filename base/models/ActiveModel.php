<?php

namespace Tritonium\Base\Models;

use Exception;
use PDOException;
use Tritonium\Base\App;
use Tritonium\Base\BaseClass;
use Tritonium\Base\Services\ActiveQuery;
use Tritonium\Base\Services\PDO;


class ActiveModel extends BaseClass
{
    /**
     * @var PDO
     */
    protected PDO $connect;
    /**
     * @var string
     */
    protected string $table;
    /**
     * @var string
     */
    protected mixed $key;
    /**
     * @var bool
     */
    protected mixed $isNewRecord = true;
    /**
     * @var array
     */
    protected array $attributes = [];
    /**
     * @var array
     */
    protected array $properties = [];
    /**
     * @var array
     */
    protected array $readonly = [];

    public function __construct($isNew = true)
    {
        $this->connect = App::$components->db;
        $this->isNewRecord = $isNew;

        $rs = $this->connect->query('SELECT * FROM ' . $this->getTable() . ' LIMIT 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $this->attributes[] = $col['name'];
        }

        $rs = $this->connect->query('SHOW KEYS FROM ' . $this->getTable() . ' WHERE Key_name = \'PRIMARY\';');
        $this->key = $rs->fetchColumn(4);
    }

    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return array
     * @deprecated
     */
    public static function all()
    {
        return self::find()->all(true);
    }

    public static function find(): ActiveQuery
    {
        $model = new static();
        $query = new ActiveQuery($model->getClassNameFull());

        return $query->select('*')->from($model->getTable());
    }

    public function delete(): bool
    {
        $sql = 'DELETE FROM `' . $this->getTable() . '` WHERE ' . $this->getKey() . ' = ?';
        $stmt = $this->connect->prepare($sql);

        return ($stmt->execute([$this->getKeyValue()]));
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getKeyValue(): string
    {
        return $this->properties[$this->key];
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Returns value of the Model primary key, in most cases simply returns ID.
     *
     * @return int
     */
    public function getID(): int
    {
        return $this->getKeyValue();
    }

    public function getLabel($key)
    {
        return ucwords(str_replace('_', ' ', $key));
    }

    public function isReadOnly($attribute)
    {
        return in_array($attribute, $this->readonly);
    }

    public function save()
    {
        $attributes = array_flip($this->attributes);
        $data = array_filter($this->properties, function ($prop) use ($attributes) {
            return (isset($attributes[$prop]) && !empty($this->properties[$prop]));
        }, ARRAY_FILTER_USE_KEY);

        if ($this->isNewRecord) {
            $values = $cols = [];
            foreach ($data as $key => $value) {
                $values[] = ":$key";
                $cols[] = "`$key`";
            }
            $cols_string = implode(',', $cols);
            $vals_string = implode(',', $values);

            $sql = "INSERT INTO `{$this->getTable()}` ({$cols_string}) VALUES ({$vals_string})";
            $statement = $this->connect->prepare($sql);
            foreach ($data as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }

            try {
//                $this->connect->beginTransaction();
                $statement->execute();
//                $this->connect->commit();

                if (isset($data[$this->getKey()])) {
                    $model_id = $this->getKeyValue();
                } else {
                    $model_id = $this->connect->lastInsertId();
                }
                $this->isNewRecord = false;
                $this->properties = $this->byID($model_id)->__toArray();

                return $model_id;
            } catch (PDOException $exception) {
                if ($this->connect->inTransaction()) {
                    $this->connect->rollback();
                }

                var_dump($statement->debugDumpParams());
                throw $exception;
            }
        } else {
            //Saving updated record
            $sql = "UPDATE `{$this->getTable()}` SET ";
            $primary_key = $data[$this->key];
            unset($data[$this->key]);
            //TODO unset secured fields here

            foreach ($data as $key => $value) {
                $sql .= "`$key` = :$key, ";
            }
            $sql = trim($sql, ', ');
            $sql .= ' WHERE `' . $this->key . '` = :' . $this->key;


            $statement = $this->connect->prepare($sql);
            $statement->bindValue(':' . $this->key, $primary_key);
            foreach ($data as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }

            try {
                $this->connect->beginTransaction();
                $statement->execute();
                $this->connect->commit();

                return $this->connect->lastInsertId();
            } catch (PDOException $e) {
                $this->connect->rollback();

                return "Error" . $e->getMessage();
            }
        }
    }

    public function __toArray(): array
    {
        return $this->properties;
    }

    public static function byID($id): ?ActiveModel
    {
        $model = new static();
        try {
            return $model->find()->where($model->getKey(), '=', $id)->one();
        } catch (Exception) {
            return null;
        }
    }

    public function __get($method)
    {
        return $this->properties[$method] ?? null;
    }

    public function __set($name, $value): void
    {
        $this->properties[$name] = in_array($name, $this->attributes) ? $value : null;
    }
}
