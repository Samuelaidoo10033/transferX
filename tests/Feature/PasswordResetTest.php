<?php

namespace Tests\Unit;

use App\Http\Controllers\CompleteForgotPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_reset_password_email_code_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post(action(ForgotPasswordController::class),[
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
        $response->assertSuccessful();


    }

    public function test_password_can_be_reset_with_valid_email_token()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(action(ForgotPasswordController::class), [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post(action(CompleteForgotPasswordController::class), [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSuccessful();
            return true;
        });
    }
}
