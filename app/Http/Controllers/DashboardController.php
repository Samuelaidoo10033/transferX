<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user()->id;

        // Retrieve the total recipient count
        $recipientData = Recipient::where('user_id', $user)->count();

        $walletBalances = Wallet::where('user_id', $user)->select('currency', DB::raw('SUM(balance) as total_balance'))
            ->groupBy('currency')
            ->get()
            ->pluck('total_balance', 'currency')
            ->toArray();

        $totalTransactions = Transaction::where('user_id', $user)->count();

        return response()->json([
            'recipient_count' => $recipientData,
            'cedi_wallet_balance' => $walletBalances['GHS'] ?? 0,
            'naira_wallet_balance' => $walletBalances['NGN'] ?? 0,
            'total_transactions' => $totalTransactions,
        ]);


    }
}
