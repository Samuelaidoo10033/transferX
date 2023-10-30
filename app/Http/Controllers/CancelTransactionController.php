<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CancelTransactionController extends Controller
{
    public function __invoke(Request $request, string $reference)
    {
        $transaction = Transaction::where('reference', $reference)->firstOrFail();
        $transaction->cancel();
        return $this->response($transaction, 'Transaction cancelled');
    }
}
