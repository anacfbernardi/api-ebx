<?php

namespace App\Business\Event;

use App\Repository\Accounts\AccountsRepository;
use App\Repository\Balances\BalancesRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;

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
        try {
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
        } catch (NotFoundHttpException $e) {
            return [];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function formatResponse($data, $account_type)
    {
        return !empty($data) ? [
            $account_type => [
                'id' => strval($data['account_id']),
                'balance' => $data['balance']
            ]
        ] : [];
    }

    private function deposit($data)
    {
        $accountId = $data['destination'];

        if ($this->accountExists($accountId)) {
            return  $this->formatResponse(
                $this->updateAccountBalance($accountId, $data['amount']),
                'destination'
            );
        }

        return $this->formatResponse(
            $this->createNewAccountWithInitialBalance(
                $accountId,
                $data['amount']
            ),
            'destination'
        );
    }

    private function withdraw($data)
    {
        $accountId = $data['origin'];

        if (!$this->accountExists($accountId)) {
            throw new NotFoundHttpException();
        }

        return $this->formatResponse(
            $this->updateAccountBalance($accountId, $data['amount'] * -1),
            'origin'
        );
    }

    private function transfer($data)
    {
        $origin = $this->withdraw($data);
        $destination = $this->deposit($data);

        return [
            $origin,
            $destination
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
        return ($this->accountsRepository->getById($accountId)->count() > 0);
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
        return $this->insertBalance($accountId, $initialBalance);
    }


    /**
     * Calculates and insert the new account balance
     *
     * @param int $accountId
     * @param float $value
     * @return mixed
     */
    function updateAccountBalance($accountId, $value)
    {
        $lastBalance = $this->getLastAccountBalance($accountId);
        $newBalance = $lastBalance + $value;

        return $this->insertBalance($accountId, $newBalance);
    }


    /**
     * Insert the account balance
     *
     * @param int $accountId
     * @param float $value
     * @return float
     */
    private function insertBalance($accountId, $value)
    {
        return $this->balanceRepository->create([
            'account_id' => $accountId,
            'balance' => $value
        ]);
    }
}
