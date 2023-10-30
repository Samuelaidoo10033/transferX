<?php

namespace App\Http\Controllers;

use App\Actions\GetCompanyAccountAction;
use App\Actions\SendMoneyAction;
use App\Enum\Currency;
use App\Enum\Destination;
use App\Enum\PaymentMethod;
use App\Http\Requests\SendMoneyRequest;
use App\Models\User;
use App\Notifications\AdminTransactionNotification;
use Illuminate\Support\Facades\Notification;

class SendMoneyController extends Controller
{
    public function __invoke(SendMoneyRequest $request)
    {
        try{
            $transaction = SendMoneyAction::run($request->recipient_id, auth()->id(),$request->amount, Currency::from($request->from_currency),
                Currency::from($request->to_currency), PaymentMethod::from($request->payment_method), Destination::from($request->destination) );

            $companyAccount = GetCompanyAccountAction::run(Currency::from($request->from_currency));

            // Notify admin about the pending transaction
            $admin = User::where('role', 'admin')->first();
            Notification::send($admin, new AdminTransactionNotification($transaction));


        }catch (\Exception $exception){
            return $this->response(null, $exception->getMessage(), 400);
        }

        return $this->response([
            'transaction' => $transaction,
            'company_account' => str_replace("\r\n", " ", $companyAccount->value),
            ],'Transaction created successfully');
    }
}
