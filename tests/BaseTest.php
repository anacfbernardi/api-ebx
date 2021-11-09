<?php

namespace Tests;

use Tests\TestCase;
use App\Repository\Accounts\AccountsRepository;
use App\Repository\Balances\BalancesRepository;

/**
 * Base tests class
 */
class BaseTest extends TestCase
{
    private $accountsRepo;
    private $balanceRepo;

    protected function resetDatabase()
    {
        $this->accountsRepo->delete_all();
        $this->balanceRepo->delete_all();
    }

    protected function createAccount(int $accountId, float $balance)
    {
        $this->accountsRepo->create([
            'account_id' => $accountId
        ]);
        $this->balanceRepo->create([
            'account_id' => $accountId,
            'balance' => $balance
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->accountsRepo = new AccountsRepository();
        $this->balanceRepo = new BalancesRepository();

        $this->resetDatabase();
    }

    protected function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }
}
