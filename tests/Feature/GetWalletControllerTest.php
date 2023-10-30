<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetWalletControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function testGetWallets()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        // Make an API request to invoke the __invoke method
        $response = $this->getJson('/api/wallets');

        // Assert the response status code
        $response->assertStatus(200);
    }
}
