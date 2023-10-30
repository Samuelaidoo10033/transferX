<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function __invoke(string $code)
    {
        $code = Code::where('code',$code)->first();

        if($code) {
            $user = User::find($code->user_id);
            $user->email_verified_at = now();
            $user->save();
            $code->delete();
            return response()->json([
                'message' => 'Email Verified'
            ]);
        }

        return response()->json([
            'message' => 'Invalid Token'
        ],404);


    }
}
