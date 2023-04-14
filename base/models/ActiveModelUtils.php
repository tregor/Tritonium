<?php

namespace Tritonium\Base\Models;


use Tritonium\base\exceptions\ActiveQueryException;


trait ActiveModelUtils
{
    /**
     * @return self[]
     */
    public static function all($asArray = true)
    {
        return self::find()->all($asArray);
    }

    /**
     * @param $id
     *
     * @return self
     * @throws ActiveQueryException
     */
    public static function byID($id)
    {
        $model = new static;

        return $model->find()->where($model->getKey(), '=', $id)->one();
    }

    public function getCreatedDatetimeString($format = 'm/d/Y H:i:s')
    {
        return date($format, strtotime($this->created_at));
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
}
