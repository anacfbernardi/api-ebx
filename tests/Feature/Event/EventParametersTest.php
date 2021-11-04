<?php

namespace Tests\Feature\Event;

use Tests\TestCase;

/**
 * Event endpoints tests
 */
class EventParametersTest extends TestCase
{
    public function test_1_event_invalid_method()
    {
        $response = $this->get('/event');
        $response->seeStatusCode(405);
    }

    public function test_2_event_invalid_request()
    {
        $response = $this->post('/event');
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "type" => ["The type field is required."],
                "amount" => ["The amount field is required."]
            ]
        );
    }

    public function test_3_event_invalid_request_param()
    {
        $response = $this->post('/event', [
            'teste' => ''
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "type" => ["The type field is required."],
                "amount" => ["The amount field is required."]
            ]
        );
    }

    /**
     * Invalid type tests
     */

    public function test_4_event_invalid_type_value_param()
    {
        $response = $this->post('/event', [
            'type' => 'teste'
        ]);

        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "type" => ["The selected type is invalid."],
                "amount" => ["The amount field is required."]
            ]
        );
    }

    public function test_5_event_invalid_amount_value_param()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 1,
            'amount' => 'aaa'
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "amount" => ["The amount must be a number."]
            ]
        );
    }

    public function test_6_event_invalid_destination_value_param()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 'aaa',
            'amount' => 50
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "destination" => ["The destination must be a number."]
            ]
        );
    }

    public function test_7_event_invalid_origin_value_param()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 'aaa',
            'amount' => 50
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "origin" => ["The origin must be a number."]
            ]
        );
    }

    /**
     * 
     * Conditional missing params tests
     * 
     */

    /**
     * deposit
     */
    public function test_8_event_deposit_missing_destination()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'amount' => 500
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "destination" => ["The destination field is required when type is deposit."]
            ]
        );
    }

    public function test_9_event_deposit_missing_amount()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 1
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "amount" => ["The amount field is required."]
            ]
        );
    }


    /**
     * withdraw
     */
    public function test_10_event_withdraw_missing_origin()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'amount' => 500
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "origin" => ["The origin field is required when type is withdraw."]
            ]
        );
    }

    public function test_11_event_withdraw_missing_amount()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 1
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "amount" => ["The amount field is required."]
            ]
        );
    }

    /**
     * transfer
     */
    public function test_12_event_transfer_missing_destination()
    {
        $response = $this->post('/event', [
            'type' => 'transfer',
            'origin' => 2,
            'amount' => 500
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "destination" => ["The destination field is required when type is transfer."],
            ]
        );
    }

    public function test_13_event_transfer_missing_origin()
    {
        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 1,
            'amount' => 500
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "origin" => ["The origin field is required when type is transfer."]
            ]
        );
    }

    public function test_14_event_transfer_missing_amount()
    {
        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 1,
            'origin' => 2
        ]);
        $response->seeStatusCode(422);
        $response->seeJsonEquals(
            [
                "amount" => ["The amount field is required."]
            ]
        );
    }


    /**
     * 
     * Success tests
     * 
     */
    public function test_15_event_deposit_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 1,
            'amount' => 500
        ]);
        $response->seeStatusCode(201);
    }

    public function test_16_event_withdraw_success()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 666,
            'amount' => 500
        ]);
        $response->seeStatusCode(201);
    }

    public function test_17_event_transfer_success()
    {
        $response = $this->post('/event', [
            'type' => 'transfer',
            'destination' => 1,
            'origin' => 2,
            'amount' => 500
        ]);
        $response->seeStatusCode(201);
    }
}
