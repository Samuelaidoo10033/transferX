<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Recipient;

class RecipientsController extends Controller
{

    public function __invoke()
    {
        $user = auth()->user();

        $recipients = Recipient::where('user_id', $user->id)->paginate(20);

        return $this->response($recipients);
    }
}
