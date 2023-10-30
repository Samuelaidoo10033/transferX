<?php

namespace Tests\Unit;

use App\Actions\SendEmailVerificationCodeAction;
use App\Http\Controllers\VerifyEmailController;
use App\Models\Code;
use App\Models\User;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    /** @test */
    public function users_can_verify_their_emails()
    {
        $user = User::factory()->create();
        SendEmailVerificationCodeAction::run($user);

        $response = $this->get(action(VerifyEmailController::class,[
            'code' => Code::first()->code
        ]));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Email Verified',
            ]);
    }
}
