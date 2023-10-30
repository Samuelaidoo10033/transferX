<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetWalletController extends Controller
{
    public function __invoke()
    {
        $userId = Auth::id();

        $wallets = DB::table('wallets')
            ->where('user_id', $userId)
            ->get();

        return response()->json($wallets);
    }
}
