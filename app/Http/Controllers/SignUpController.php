<?php

namespace App\Http\Controllers;

use App\Actions\CreateWalletAction;
use App\Actions\SendEmailVerificationCodeAction;
use App\Http\Requests\SignUpRequest;
use App\Jobs\WalletCreation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function __invoke(SignUpRequest $request)
    {
        $user = new User();
        $user->firstname = request()->input('firstname');
        $user->lastname = request()->input('lastname');
        $user->email = request()->input('email');
        $user->country = request()->input('country');
        $user->password = Hash::make(request()->input('password'));
        $user->save();

        SendEmailVerificationCodeAction::run($user);

        $resp = new UserResource($user);

        foreach (explode(',',config('tranzie.default_currencies')) as $currency) {
            CreateWalletAction::run($user, $currency);
        }
        return response()->json([
            'message' => "Registration Successful",
            'user'  => new UserResource($user)
        ]);
    }

}
