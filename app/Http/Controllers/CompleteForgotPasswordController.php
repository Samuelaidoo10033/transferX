<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class CompleteForgotPasswordController extends Controller
{
    public function __invoke(CompleteResetPasswordRequest $request)
    {
        $response = Password::reset($request->only(
            'email', 'password', 'password_confirmation', 'token'
        ), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password)
            ])->save();
        });

        return $response == Password::PASSWORD_RESET
            ? $this->response([], trans($response))
            : $this->response([], trans($response), 424);

    }
}
