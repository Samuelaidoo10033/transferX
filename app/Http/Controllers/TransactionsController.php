<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function __invoke()
    {
        // Get logged in user
        $user = auth()->user();

        // Fetch user's transactions
        $transactions = Transaction::where('user_id', $user->id)
            ->paginate(20);

        // Return transactions as JSON response
        return $this->response($transactions);
    }
}
