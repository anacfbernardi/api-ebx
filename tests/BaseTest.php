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
        AccountsModel::factory()->state([
            'account_id' => '100',
            'account_name' => 'teste'
        ])->make();
    }

    protected function tearDown(): void
    {
        // $this->model->where('id_empresa', '=', 997)->delete();
        parent::tearDown();
    }
}
