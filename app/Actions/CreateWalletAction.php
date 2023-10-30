<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateWalletAction
{
    use AsAction;
    public function handle(User $user, $currency = 'NGN'): void
    {

        DB::transaction(function () use ($user, $currency) {
            $wallet = new Wallet();
            $wallet->number = substr(uniqid(), -10);
            $wallet->currency = $currency;
            $wallet->country = $user->country;
            $wallet->balance = 0;
            $wallet->user_id = $user->id;
            $wallet->save();
        });
    }
}
