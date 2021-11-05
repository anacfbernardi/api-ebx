<?php

namespace Tests\Feature\Event;

use Tests\TestCase;

/**
 * Transfer event tests
 */
class EventTransferTest extends TestCase
{
    // --
    // # Transfer from existing account

    // POST /event {"type":"transfer", "origin":"100", "amount":15, "destination":"300"}

    // 201 {"origin": {"id":"100", "balance":0}, "destination": {"id":"300", "balance":15}}

    // --
    // # Transfer from non-existing account

    // POST /event {"type":"transfer", "origin":"200", "amount":15, "destination":"300"}

    // 404 0

    public function test_1_event_transfer_success()
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
