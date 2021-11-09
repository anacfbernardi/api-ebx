<?php

namespace Tests\Feature\Event;

use Tests\BaseTest;

/**
 * Withdraw Event tests
 */
class EventWithdrawTest extends BaseTest
{
    public function test_1_event_withdraw_non_existing_account_status_code()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 666,
            'amount' => 500
        ]);
        $response->seeStatusCode(404);
    }

    public function test_2_event_withdraw_non_existing_account_contract()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 666,
            'amount' => 500
        ]);

        $response->seeJson([0]);
    }

    public function test_3_event_withdraw_existing_account_status_code()
    {
        $this->createAccount(100, 20);

        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 100,
            'amount' => 5
        ]);
        $response->seeStatusCode(201);
    }

    public function test_4_event_withdraw_existing_account_contract()
    {
        $this->createAccount(100, 20);

        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 100,
            'amount' => 5
        ]);

        $expected = [
            "origin" => [
                "id" => "100",
                "balance" => 15
            ]
        ];

        $response->seeJson($expected);
    }
}
