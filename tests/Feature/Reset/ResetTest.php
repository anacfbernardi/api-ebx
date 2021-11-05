<?php

namespace Tests\Feature\Reset;

use Tests\TestCase;

/**
 * Reset endpoints tests
 */
class ResetTest extends TestCase
{
    public function test_1_reset_invalid_method()
    {
        $response = $this->get('/reset');
        $response->seeStatusCode(405);
    }

    public function test_2_reset_success()
    {
        $response = $this->post('/reset');
        $response->seeStatusCode(200);
    }
}
