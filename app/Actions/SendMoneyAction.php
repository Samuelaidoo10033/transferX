<?php

namespace App\Actions;

use App\Enum\Currency;
use App\Enum\Destination;
use App\Enum\PaymentMethod;
use App\Enum\TransactionStatus;
use App\Models\Rate;
use App\Models\Recipient;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Transaction run(int $recipientId, int $userId, int $amount, Currency $from, Currency $to, PaymentMethod $paymentMethod, Destination $destination)
 */
class SendMoneyAction
{
    use AsAction;

    public function handle(int $recipientId,
        int $userId, int $amount, Currency $from, Currency $to,
        PaymentMethod $paymentMethod, Destination $destination ): Transaction
    {
        $user    = User::find($userId);

        /** @var Recipient $recipient */
        $recipient = Recipient::find($recipientId);

        if (!$user || !$recipient) {
            throw new \Exception('Invalid user or recipient!');
        }

        /** @var Rate $rate */
        $rate = GetRateAction::run($from, $to);

        DB::beginTransaction();

        try {
            $transaction                 = new Transaction();
            $transaction->user_id        = $user->id;
            $transaction->recipient_id   = $recipient->id;
            $transaction->amount         = $amount;
            $transaction->payment_method = $paymentMethod->value;
            $transaction->status         = TransactionStatus::PENDING->value;
            $transaction->from           = $from->value;
            $transaction->to             = $to->value;
            $transaction->reference      = GetTransactionReferenceAction::run();
            $transaction->rate           = $rate->amount;
            $transaction->fee            = 0;
            $transaction->recipient_name   = $recipient->name;
            $transaction->recipient_number = $recipient->number;
            $transaction->recipient_provider = $recipient->provider;
            $transaction->bank_code      = $recipient->bank_code;
            $transaction->destination    = $destination->value;
            $transaction->save();


            if ($paymentMethod == PaymentMethod::WALLET) {
                // if the user is paying from the wallet we can move it to processing immediately
                $wallet = Wallet::forUser($user->id, $from);

                if (!$wallet) {
                    throw new \Exception('Wallet not found');
                }

                if ($wallet->balance < $amount) {
                    throw new \Exception('Insufficient funds in the wallet');
                }

                $wallet->balance = $wallet->balance - $amount;
                $wallet->save();

                $transaction->wallet_id = $wallet->id;
                $transaction->status = TransactionStatus::PROCESSING->value;
                $transaction->save();

            }

            DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
