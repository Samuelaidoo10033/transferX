<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignOutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();

        return $this->response([], 'User logged out successfully.');

    }
}
