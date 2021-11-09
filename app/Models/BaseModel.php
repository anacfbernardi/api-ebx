<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Base Model.
 */
class BaseModel extends Model
{

    protected function strToFloat(string $value = null)
    {
        if ($value)
            return floatval($value);

        return 0;
    }
}
