<?php

namespace Tests\Feature\Lancamentos\ContasReceber;

use Tests\TestCase;

/**
 * Testes dos endpoints de evento
 */
class EventTest extends TestCase
{
    public function test_1_event_invalid_method()
    {
        $response = $this->get('/event');
        $response->assertResponseStatus(405);
    }

    public function test_2_event_invalid_request()
    {
        $response = $this->post('/event');
        $response->assertResponseStatus(422);
    }
}
