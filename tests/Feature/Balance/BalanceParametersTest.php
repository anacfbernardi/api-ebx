<?php

namespace Tests\Feature\Balance;

use Tests\TestCase;

/**
 * Balance endpoints tests
 */
class BalanceParametersTest extends TestCase
{
    public function test_1_balance_invalid_method()
    {
        $response = $this->post('/balance');
        $response->assertResponseStatus(405);
    }

    public function test_2_balance_invalid_request()
    {
        $response = $this->get('/balance');
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "account_id" => ["The account id field is required."]
            ]
        );
    }

    public function test_3_balance_invalid_account_id_value()
    {
        $response = $this->get('/balance?account_id=aaa');
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "account_id" => ["The account id must be a number."]
            ]
        );
    }

    public function test_4_balance_success()
    {
        $response = $this->get('/balance?account_id=1');

        $response->seeStatusCode(200);
    }
}
