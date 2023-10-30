<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GetTransactionController extends Controller
{

    public function __invoke(Request $request, string $reference)
    {
        $transaction = Transaction::where('reference',$reference)->firstOrFail();
        return $this->response(new TransactionResource($transaction));
    }
}
