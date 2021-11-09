<?php

namespace Tests\Feature\Event;

use Tests\BaseTest;

/**
 * Transfer event tests
 */
class EventTransferTest extends BaseTest
{
    public function test_1_event_transfer_from_existing_account_status_code()
    {
        $this->createAccount(100, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 100,
            'amount' => 15
        ]);

        $response->seeStatusCode(201);
    }

    public function test_2_event_transfer_from_existing_account_contract()
    {
        $this->createAccount(100, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 100,
            'amount' => 15
        ]);

        $expected = [
            "origin" => [
                "id" => "100",
                "balance" => 0
            ],
            "destination" => [
                "id" => "300",
                "balance" => 15
            ]
        ];

        $response->seeJson($expected);
    }

    public function test_3_event_transfer_from_non_existing_account_status_code()
    {
        $this->createAccount(300, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 200,
            'amount' => 15
        ]);

        $response->seeStatusCode(404);
    }

    public function test_4_event_transfer_from_non_existing_account_contract()
    {
        $this->createAccount(300, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 200,
            'amount' => 15
        ]);

        $response->seeJson([0]);
    }

    public function test_5_event_transfer_to_existing_account_status_code()
    {
        $this->createAccount(100, 15);
        $this->createAccount(300, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 100,
            'amount' => 15
        ]);

        $response->seeStatusCode(201);
    }

    public function test_4_event_transfer_to_existing_account_contract()
    {
        $this->createAccount(100, 15);
        $this->createAccount(300, 15);

        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 300,
            'origin' => 100,
            'amount' => 15
        ]);

        $expected = [
            "origin" => [
                "id" => "100",
                "balance" => 0
            ],
            "destination" => [
                "id" => "300",
                "balance" => 30
            ]
        ];

        $response->seeJson($expected);
    }
}
