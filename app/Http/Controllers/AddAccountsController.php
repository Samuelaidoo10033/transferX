<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAccountRequest;
use App\Http\Resources\AccountsResource;
use App\Models\Accounts;
use Illuminate\Http\Request;

class AddAccountsController extends Controller
{
    public function __invoke(AddAccountRequest $request)
    {
        // Create a new account instance
        $account = new Accounts();

        // Set each property individually
        $account->user_id = auth()->id();
        $account->type = $request->type;
        $account->currency = $request->currency;
        $account->country = $request->country;
        $account->account_name = $request->account_name;
        $account->account_number = $request->account_number;
        $account->account_provider = $request->account_provider;
        $account->bank_code = $request->bank_code;

        // Save the account information
        $account->save();

        return $this->response(new AccountsResource($account));


    }
}
