<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminDeclinePaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);

        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }

        $transaction->status = 'declined';
        $transaction->save();

        return response()->json([
            'message' => 'Transaction declined successfully'
        ]);
    }
}
