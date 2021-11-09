<?php

namespace Tests;

use Tests\TestCase;
use App\Models\Accounts\AccountsModel;
use App\Models\Accounts\BalanceModel;

/**
 * Base tests class
 */
class BaseTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->get('/reset');
    }

    protected function tearDown(): void
    {
        $this->get('/reset');
        parent::tearDown();
    }
}
