<?php

namespace App\Http\Controllers;

use App\Enum\TransactionStatus;
use App\Http\Requests\ConfirmPaymentRequest;
use App\Models\Transaction;

class ConfirmPaymentController extends Controller
{
    public function __invoke(ConfirmPaymentRequest $request, string $reference)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::forUser()->where('reference', $reference)->first();

        if (!$transaction) {
            return $this->response(null, 'Transaction not found', 404);
        }

        if ($transaction->status !== TransactionStatus::PENDING->value) {
            return $this->response(null, 'Transaction is not pending', 400);
        }

        $transaction->status = TransactionStatus::PROCESSING->value;
        $transaction->setMeta('confirmed_at', now());
        $transaction->save();

        return $this->response($transaction, 'Processing transaction');

    }
}
