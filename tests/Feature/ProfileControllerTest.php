<?php

namespace Tests\Feature;

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_user_profile()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->getJson(action([ProfileController::class, 'index']));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'country',
                    'wallets',
                    'created_at',
                    'updated_at'
                ],
                'message'
            ])
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'country' => $user->country,
                ],
                'message' => 'Successful'
            ]);
    }

    public function test_update_updates_user_profile()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $updatedData = [
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
            'country' => 'UpdatedCountry',
        ];

        // Act
        $response = $this->postJson(action([ProfileController::class,'update']), $updatedData);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'firstname' => $updatedData['firstname'],
                    'lastname' => $updatedData['lastname'],
                    'country' => $updatedData['country'],
                ],
                'message' => 'Profile updated'
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => $updatedData['firstname'],
            'lastname' => $updatedData['lastname'],
            'email' => $user->email,
            'country' => $updatedData['country'],
        ]);
    }

}
