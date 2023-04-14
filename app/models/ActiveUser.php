<?php

namespace Tritonium\App\Models;

use Tritonium\Base\Models\ActiveModel;

class ActiveUser extends ActiveModel
{

    /**
     * @var string Table in which model's data is stored
     */
    protected string $table = 'users';
}
