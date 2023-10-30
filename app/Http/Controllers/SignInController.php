<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {

            return $this->response([], 'Invalid credentials', 442);
        }

        $user = auth()->user();
        $data['token'] = explode('|', $user->createToken("auth_token")->plainTextToken)[1];
        $data['user'] = $user;

        return $this->response($data, "User signed in successfully");
    }
}
