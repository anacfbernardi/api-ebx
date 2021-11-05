<?php

namespace App\Repository\Balances;

use App\Models\Balance\BalancesModel;
use App\Repository\BaseRepository;

/**
 * Balance repository class
 */
class BalancesRepository extends BaseRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new BalancesModel();
    }

    /**
     * Get last balance
     *
     * @param int $accountId
     * @return mixed
     * @throws \Exception
     */
    public function getLastBalance(int $accountId)
    {
        try {
            return $this->model
                ->select()
                ->where('account_id', $accountId)
                ->orderByDesc('created_at')
                ->limit(1)
                ->get();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
