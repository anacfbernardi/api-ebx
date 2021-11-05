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
     * Insert new balance
     *
     * @return \App\Model\Balance\BalancesModel
     */
    public function create(array $data)
    {
        return $this->balancesRepository->create($data);
    }

    /**
     * Get last account balance
     *
     * @return \App\Model\Balance\BalancesModel
     */
    public function getBalance(int $accountId)
    {
        return $this->balancesRepository->getLastBalance($accountId);
    }
}
