<?php

namespace Tests\Feature\Balance;

use Tests\TestCase;

/**
 * Balance endpoints tests
 */
class BalanceTest extends TestCase
{
    public function test_1_balance_non_existing_account_error()
    {
        $response = $this->get('/balance?account_id=1234');

        $response->seeStatusCode(404);
    }

    public function test_2_balance_existing_account_success()
    {
        $response = $this->get('/balance?account_id=100');

        $response->seeStatusCode(200);
    }
}
