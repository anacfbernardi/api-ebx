<?php

namespace App\Business\Event;

use App\Repository\Accounts\AccountsRepository;
use App\Repository\Balances\BalancesRepository;
use Exception;

/**
 * Class EventBiz
 * @package App\Business\Event
 */
class EventBiz
{
    private $accountsRepository;

    private $balanceRepository;

    /**
     * AccountsBiz constructor.
     */
    public function __construct()
    {
        $this->accountsRepository = new AccountsRepository();
        $this->balanceRepository = new BalancesRepository();
    }

    /**
     * New event
     *
     * @return \App\Model\Accounts\AccountsModel
     */
    public function create(array $data)
    {
        switch ($data['type']) {
            case 'deposit':
                return $this->deposit($data);
                break;
            case 'withdraw':
                return $this->withdraw($data);
                break;
            case 'transfer':
                return $this->transfer($data);
                break;
        }
    }


    private function deposit($data)
    {
        $accountId = $data['destination'];

        if ($this->accountExists($accountId)) {
            $lastBalance = $this->getLastAccountBalance($accountId);
            return $this->updateBalance($lastBalance['balance'] + $data['amount'], $accountId);
        }

        return $this->createNewAccountWithInitialBalance(
            $accountId,
            $data['amount']
        );
    }

    private function withdraw($data)
    {
        $accountId = $data['origin'];

        if (!$this->accountExists($accountId)) {
            throw new Exception();
        }

        $lastBalance = $this->getLastAccountBalance($accountId);
        return $this->updateBalance($lastBalance['balance'] - $data['amount'], $accountId);
    }

    private function transfer($data)
    {
        $originAccountId = $data['origin'];

        if (!$this->accountExists($originAccountId)) {
            throw new Exception();
        }

        $lastBalance = $this->getLastAccountBalance($originAccountId);
        $origin = $this->updateBalance($lastBalance['balance'] - $data['amount'], $originAccountId);

        $destinationAccountId = $data['destination'];

        if ($this->accountExists($destinationAccountId)) {
            $lastBalance = $this->getLastAccountBalance($destinationAccountId);
            return $this->updateBalance($lastBalance['balance'] + $data['amount'], $destinationAccountId);
        }

        $destination = $this->createNewAccountWithInitialBalance(
            $destinationAccountId,
            $data['amount']
        );

        return [
            'origin' => $origin,
            'destination' => $destination
        ];
    }

    /**
     * Verify if the account already exists
     *
     * @param int $accountId
     * @return boolean
     */
    private function accountExists(int $accountId)
    {
        return !empty($this->accountsRepository->getById($accountId));
    }

    /**
     * Get the last account balance
     *
     * @param int $accountId
     * @return mixed
     */
    private function getLastAccountBalance(int $accountId)
    {
        return $this->balanceRepository->getLastBalance($accountId)['balance'];
    }

    /**
     * Create new account and create the initial balance
     * returns the balance values
     *
     * @param int $accountId
     * @param float $initialBalance
     * @return mixed
     */
    private function createNewAccountWithInitialBalance(int $accountId, float $initialBalance)
    {
        $this->accountsRepository->create([
            'account_id' => $accountId
        ]);
        return $this->updateBalance($accountId, $initialBalance);
    }

    /**
     * Update the account balance
     *
     * @param int $accountId
     * @param float $value
     * @return float
     */
    private function updateBalance($accountId, $value)
    {
        return $this->balanceRepository->create([
            'account_id' => $accountId,
            'balance' => $value
        ]);
    }
}
