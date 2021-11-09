<?php

namespace Tests\Feature\Event;

use Tests\BaseTest;

/**
 * Event deposit tests
 */
class EventDepositTest extends BaseTest
{
    public function test_1_event_initial_deposit_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 10
        ]);
        $response->seeStatusCode(201);
    }

    public function test_2_event_initial_deposit_contract_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 100
        ]);

        $expected = [
            'destination' => [
                'id' => '100',
                'balance' => 10
            ]
        ];

        $response->seeJsonEquals($expected);
    }

    public function test_3_event_deposit_existing_account_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 10
        ]);

        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 10
        ]);
        $response->seeStatusCode(201);
    }

    public function test_4_event_deposit_existing_account_contract_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 10
        ]);

        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 100,
            'amount' => 10
        ]);

        $expected = [
            'destination' => [
                'id' => '100',
                'balance' => 20
            ]
        ];

        $response->seeJsonEquals($expected);
    }
}
