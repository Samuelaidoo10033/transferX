<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $accounts = Accounts::where('user_id', $user->id)->paginate(20);

        return $this->response($accounts);
    }

}
