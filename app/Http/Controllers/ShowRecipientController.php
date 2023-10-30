<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;

class ShowRecipientController extends Controller
{
    public function __invoke($id)
    {
        $recipient = Recipient::with('transactions')->where('id',$id)->get();

        return response()->json($recipient);
    }
}
