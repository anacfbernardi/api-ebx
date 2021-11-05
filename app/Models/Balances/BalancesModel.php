<?php

namespace App\Models\Balance;

use App\Models\BaseModel;

class BalancesModel extends BaseModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "balances";

    /**
     * Table primary key
     *
     * @var string
     */
    protected $primaryKey = "balance_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "account_id"
    ];
}
