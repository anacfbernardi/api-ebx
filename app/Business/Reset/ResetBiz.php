<?php

namespace App\Business\Reset;

use App\Repository\Balances\BalancesRepository;
use App\Repository\Accounts\AccountsRepository;

/**
 * Class ResetBiz
 * @package App\Business\Reset
 */
class ResetBiz
{
    private $accountsRepository;

    private $balancesRepository;

    /**
     * ResetBiz constructor.
     */
    public function __construct()
    {
        $this->accountsRepository = new AccountsRepository();
        $this->balancesRepository = new BalancesRepository();
    }

    /**
     * Delete all data (accounts and balances)
     *
     * @return int
     */
    public function reset()
    {
        $this->accountsRepository->delete_all();
        $this->balancesRepository->delete_all();
        return true;
    }
}
