<?php

namespace Tritonium\Base\Models;

use Exception;
use JetBrains\PhpStorm\Pure;
use PDOException;
use Throwable;
use Tritonium\Base\App;
use Tritonium\Base\BaseClass;


class BaseModel extends BaseClass
{
    protected $connect;
    /**
     * @var string Default key of model
     */
    protected string $key = "id";
    /**
     * @var string[] List of attributes
     */
    protected array $attributes = [];
    /**
     * @var string[] List of attributes that can be read
     */
    protected array $secured = [
        'id',
        'created_at',
        'updated_at',
    ];
    /**
     * @var string[] List of labels for output
     */
    protected array $labels = [
        'id' => 'ID',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ];

    public function __construct()
    {
        // $database = App::$components->db;
        // $this->connect = $database->instance();
        $this->connect = App::$components->db;
    }

    public static function allLimit($limit = 1000, $offset = 0, $order_by = '', $sort_asc = true)
    {
        $model = new static();
        $limit = ($limit > 0) ? ' LIMIT ' . $limit : '';
        $offset = ($offset > 0) ? ' OFFSET ' . $offset : '';
        $order_by = (!empty($order_by)) ? ' ORDER BY `' . $order_by . '`' : '';
        $sort = $sort_asc ? ' ASC' : ' DESC';

        $sql = 'SELECT * FROM `' . $model->table . '` ' . $order_by . $sort . $limit . $offset;

        return $model->execute($sql);
    }

    protected function execute($sql, $params = [])
    {
        try {
            $attributes = array_flip($this->attributes);
            $result = [];
            $statement = $this->connect->prepare($sql);
            $statement->execute($params);

            foreach ($statement as $row) {
                $result[] = array_filter($row, function ($data) use ($attributes) {
                    return isset($attributes[$data]);
                }, ARRAY_FILTER_USE_KEY);
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }

        return $result;
    }

    public static function count(): int
    {
        return count(self::all());
    }

    public static function all($limit = 1000): array
    {
        $model = new static();

        return $model->execute('SELECT * FROM `' . $model->table . '` LIMIT ' . $limit);
    }

    public static function delete($value, $key = '')
    {
        $model = new static();
        if (!$key) {
            $key = $model->key;
        }

        $stmt = $model->connect->prepare('DELETE FROM `' . $model->table . '` WHERE ' . $key . ' = ?');

        return ($stmt->execute([$value]));
    }

    public static function findByOrFail($data)
    {
        $result = self::findBy($data);
        if (empty($result) or !is_array($result)) {
            throw new Exception(self::class . " not found");
        }

        return $result;
    }

    public static function findBy($data)
    {
        $model = new static();
        $sql = "SELECT * FROM `{$model->table}` WHERE ";
        $values = [];
        foreach ($data as $key => $value) {
            $sql .= "`{$key}` = ? AND ";
            $values[] = $value;
        }
        $sql = trim($sql, ' AND ');

        return $model->execute($sql, $values);
    }

    public static function first($value, $key = false)
    {
        return (isset(self::find($value, $key)[0])) ? self::find($value, $key)[0] : null;
    }

    public static function find($value, $key = false)
    {
        $model = new static();
        if (!$key) {
            $key = $model->key;
        }

        return $model->execute('SELECT * FROM `' . $model->table . '` WHERE ' . $key . ' = ?', [$value]);
    }

    public static function firstOrFail($value, $key = false)
    {
        return self::findOrFail($value, $key)[0];
    }

    public static function findOrFail($value, $key = false)
    {
        $result = self::find($value, $key);
        if (empty($result) or !is_array($result)) {
            throw new Exception(self::class . " not found");
        }

        return $result;
    }

    #[Pure]
    public static function getAttributes()
    {
        $model = new static();
        $attributes = [];

        foreach ($model->attributes as $attr) {
            if (in_array($attr, $model->secured)) {
                continue;
            }
            $attributes[] = $attr;
        }

        return $attributes;
    }

    #[Pure]
    public static function getKey()
    {
        $model = new static();

        return $model->key;
    }

    public static function getLabel($attribute)
    {
        $model = new static();

        return @$model->labels[$attribute] ?: mb_convert_case(str_replace('_', ' ', $attribute), MB_CASE_TITLE);
    }

    public static function save($data)
    {
        try {
            $model = new static();

            $attributes = array_flip($model->attributes);
            $data = array_filter($data, function ($data) use ($attributes) {
                return isset($attributes[$data]);
            }, ARRAY_FILTER_USE_KEY);

            $sql = 'UPDATE ' . $model->table . ' SET ';
            if (empty($data[$model->key])) {
                return self::create($data);
            }
            $primary_key = $data[$model->key];
            unset($data[$model->key]);
            foreach ($data as $key => $value) {
                $sql .= '`' . $key . '` = :' . $key . ', ';
            }
            $sql = trim($sql, ', ');
            $sql .= ' WHERE `' . $model->key . '` = :' . $model->key;
            $statement = $model->connect->prepare($sql);
            foreach ($data as $column => $value) {
                $statement->bindValue(':' . $column, $value);
            }
            $statement->bindValue(':' . $model->key, $primary_key);

            try {
                $model->connect->beginTransaction();
                $statement->execute();
                $model->connect->commit();

                return $model->connect->lastInsertId();
            } catch (PDOException $e) {
                $model->connect->rollback();

                return "Error1 " . $e->getMessage();
            }
        } catch (PDOException $e) {
            return "Error2 " . $e->getMessage();
        } catch (Throwable $e) {
            return "Error3 " . $e->getMessage();
        }
    }

    public static function create($data)
    {
        $model = new static();
        $attributes = array_flip($model->attributes);
        $data = array_filter($data, function ($data) use ($attributes) {
            return isset($attributes[$data]);
        }, ARRAY_FILTER_USE_KEY);
        $sql = 'INSERT INTO `' . $model->table . '` (';
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
            $model->connect->beginTransaction();
            $statement->execute();
            $model->connect->commit();

            return $model->connect->lastInsertId();
        } catch (PDOException $e) {
            $model->connect->rollback();

            throw $e;
        }
    }
}
