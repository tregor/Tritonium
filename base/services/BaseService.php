<?php

namespace Tritonium\Base\Services;

use Tritonium\Base\BaseClass;


class BaseService extends BaseClass
{
    public function __construct($data = []) {
        if ( ! empty($data)) {
            return self::configure($this, $data);
        }
    }

    public static function configure($object, $properties) {
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }

        return $object;
    }
}