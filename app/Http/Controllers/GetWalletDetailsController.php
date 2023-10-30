<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class GetWalletDetailsController extends Controller
{
    public function __invoke($wallet)
    {
        $wallet = Wallet::findOrFail($wallet);

        return response()->json($wallet);
    }
}
