<?php

namespace App\Business\Balance;

use App\Repository\Balances\BalancesRepository;

/**
 * Class BalanceBiz
 * @package App\Business\Balance
 */
class BalanceBiz
{
    private $balancesRepository;

    /**
     * BalanceBiz constructor.
     */
    public function __construct()
    {
        $this->balancesRepository = new BalancesRepository();
    }

    /**
     * Get last account balance
     *
     * @return float
     */
    public function getBalance(int $accountId)
    {
        $balance = $this->balancesRepository->getLastBalance($accountId);
        return !($balance) ? null : $balance['balance'];
    }
}
