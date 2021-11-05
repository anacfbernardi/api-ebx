<?php

namespace Tests\Feature\Event;

use Tests\TestCase;

/**
 * Withdraw Event tests
 */
class EventWithdrawTest extends TestCase
{
    // # Withdraw from non-existing account

    // POST /event {"type":"withdraw", "origin":"200", "amount":10}

    // 404 0

    // --
    // # Withdraw from existing account

    // POST /event {"type":"withdraw", "origin":"100", "amount":5}

    // 201 {"origin": {"id":"100", "balance":15}}

    public function test_16_event_withdraw_success()
    {
        $response = $this->post('/event', [
            'type' => 'withdraw',
            'origin' => 666,
            'amount' => 500
        ]);
        $response->seeStatusCode(201);
    }
}
