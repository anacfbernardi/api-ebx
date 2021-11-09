<?php

namespace Tests\Feature\Balance;

use Tests\BaseTest;

/**
 * Balance endpoints tests
 */
class BalanceTest extends BaseTest
{
    public function test_1_balance_non_existing_account_status_code()
    {
        $response = $this->get('/balance?account_id=1234');

        $response->seeStatusCode(404);
    }

    public function test_2_balance_non_existing_account_contract()
    {
        $response = $this->get('/balance?account_id=1234');

        $response->seeJson([0]);
    }    

    public function test_3_balance_existing_account_status_code()
    {
        $this->createAccount(100, 10);

        $response = $this->get('/balance?account_id=100');

        $response->seeStatusCode(200);
    }

    public function test_4_balance_existing_account_contract()
    {
        $this->createAccount(100, 10);

        $response = $this->get('/balance?account_id=100');

        $response->seeJson([10]);
    }    
}
