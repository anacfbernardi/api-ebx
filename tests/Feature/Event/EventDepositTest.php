<?php

namespace Tests\Feature\Event;

use Tests\BaseTest;

/**
 * Event deposit tests
 */
class EventDepositTest extends BaseTest
{
    // # Create account with initial balance
    
    // POST /event {"type":"deposit", "destination":"100", "amount":10}
    
    // 201 {"destination": {"id":"100", "balance":10}}
    
    
    // --
    // # Deposit into existing account
    
    // POST /event {"type":"deposit", "destination":"100", "amount":10}
    
    // 201 {"destination": {"id":"100", "balance":20}}
    

    public function test_15_event_deposit_success()
    {
        $response = $this->post('/event', [
            'type' => 'deposit',
            'destination' => 1,
            'amount' => 500
        ]);
        $response->seeStatusCode(201);
    }

}
