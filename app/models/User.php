<?php

namespace Tritonium\App\Models;

use Tritonium\Base\Models\BaseModel;

class User extends BaseModel
{

    /**
     * @var string Table in which model's data is stored
     */
    protected $table = 'users';

    /**
     * @var string Primary key, default is "ID"
     */
    protected string $key = 'user_id';

    /**
     * @var string[] List of attributes we will have access
     */
    protected array $attributes = [
        'user_id',
        'login',
        'password',
        'token'
    ];
}
