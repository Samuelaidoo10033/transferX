<?php

namespace Tests\Feature;

use App\Http\Controllers\DashboardController;
use App\Models\Recipient;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function testDashboardAPI()
    {
        // Create a user with associated data
        $user = User::factory()->create();
        Recipient::factory()->create(['user_id' => $user->id]);
        Wallet::factory()->create(['user_id' => $user->id, 'currency' => 'GHS', 'balance' => 1000]);
        Wallet::factory()->create(['user_id' => $user->id, 'currency' => 'NGN', 'balance' => 2000]);
        Transaction::factory()->count(5)->create(['user_id' => $user->id]);

        // Authenticate the user
        $this->actingAs($user, 'api');

        // Send a GET request to the dashboard API
        $response = $this->getJson('api/dashboard');

        // Assert the response is successful
        $response->assertOk();

        // Assert the response JSON contains the expected data
        $response->assertJsonStructure([
            'recipient_count',
            'cedi_wallet_balance',
            'naira_wallet_balance',
            'total_transactions',
        ]);
    }
}
