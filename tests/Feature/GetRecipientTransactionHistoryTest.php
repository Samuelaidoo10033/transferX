<?php

namespace Tests\Feature;

use App\Models\Recipient;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRecipientTransactionHistoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function testGetRecipientTransactionHistoryWithTransactions()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        // Create a recipient
        $recipient = Recipient::factory()->create();

        // Create some transactions associated with the recipient
        Transaction::factory()->count(3)->create(['recipient_id' => $recipient->id]);

        // Make an API request to invoke the __invoke method
        $response = $this->getJson("/api/recipients/{$recipient->id}");

        // Assert the response status code
        $response->assertStatus(200);

    }
}
