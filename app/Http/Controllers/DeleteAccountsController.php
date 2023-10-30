<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class DeleteAccountsController extends Controller
{
    public function __invoke(Accounts $account)
    {

        if($account->user_id !== auth()->id()) {
            return response()->json(['message' => 'You are not authorized to delete this recipient'], 403);
        }

        $account->delete();

        return response()->json(['message' => 'Account deleted successfully']);

    }
}
