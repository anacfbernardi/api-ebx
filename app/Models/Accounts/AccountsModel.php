<?php

namespace App\Models\Accounts;

use App\Models\BaseModel;

class AccountsModel extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "accounts";

    /**
     * Table primary key
     *
     * @var string
     */
    protected $primaryKey = "account_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
    ];
}
