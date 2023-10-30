<?php

namespace Tests\Unit;

use App\Http\Controllers\SignInController;
use App\Models\User;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    /** @test */
    public function user_can_sign_in()
    {
        $user = User::factory()->create();
        $response = $this->post(action(SignInController::class),[
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }
}
