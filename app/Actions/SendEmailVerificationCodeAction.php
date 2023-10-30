<?php

namespace App\Actions;

use App\Models\Code;
use App\Models\User;
use App\Notifications\SignUpNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class SendEmailVerificationCodeAction
{
    use AsAction;

    public function handle(User $user)
    {

        $code = Code::create([
            'user_id' => $user->id,
            'code' => $this->generateRandomUniqueToken(),
            'type' => 'email',
            'destination' => $user->email
        ]);

        // Send email
        Notification::send($user, new SignUpNotification($code));

        $code->sent_at = now();
        $code->save();

    }

    public function generateRandomUniqueToken(): string
    {
        $token = Str::random(32);
        while (Code::where('code', $token)->exists()) {
            $this->generateRandomUniqueToken();
        }

        return $token;
    }
}
