<?php

namespace Tests\Feature;

use App\Enum\Currency;
use App\Enum\Destination;
use App\Http\Controllers\AddAccountsController;
use App\Models\Accounts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountsControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */

    public function users_can_add_bank_account()
    {
        Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));

        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $accountData = [
            'type' => Destination::BANK->value,
            'currency' => Currency::GHC->value,
            'country' => 'GH',
            'account_name' => 'Test Account',
            'account_number' => '1234567890',
            'account_provider' => 'Bank of Ghana',
            'bank_code' => '123',
        ];

        // Act
        $response = $this->postJson(action(AddAccountsController::class), $accountData);

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'type',
                    'currency',
                    'country',
                    'account_name',
                    'account_number',
                    'account_provider',
                    'bank_code',
                    'metadata',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => $accountData,
            ]);

        $account = $response->json('data');

        $this->assertEquals($account, Accounts::first()->toArray());

    }

    /**
     * @test
     */

    public function users_can_add_momo_account()
    {
        Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));

        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $accountData = [
            'type' => Destination::MOBILE_MONEY->value,
            'currency' => Currency::GHC->value,
            'country' => 'GH',
            'account_name' => 'John Sam',
            'account_number' => '0542021425',
            'account_provider' => 'MTN Momo',
            'bank_code' => '123',
        ];

        // Act
        $response = $this->postJson(action(AddAccountsController::class), $accountData);

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'type',
                    'currency',
                    'country',
                    'account_name',
                    'account_number',
                    'account_provider',
                    'bank_code',
                    'metadata',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => $accountData,
            ]);

        $account = $response->json('data');

        $this->assertEquals($account, Accounts::first()->toArray());

    }

}
