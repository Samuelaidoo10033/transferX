<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GetRecipientTransactionHistory extends Controller
{
    public function __invoke(Recipient $recipient)
    {
        $transactions = Transaction::where('recipient_id', $recipient->id)->get();

        return $this->response($transactions);
    }
}
