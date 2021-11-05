<?php

namespace App\Repository\Accounts;

use App\Models\Accounts\AccountsModel;
use App\Repository\BaseRepository;

/**
 * Accounts repository class
 */
class AccountsRepository extends BaseRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new AccountsModel();
    }

    public function getById($accountId)
    {
        return $this->model->select()
            ->where('account_id', $accountId)
            ->get();
    }
}
