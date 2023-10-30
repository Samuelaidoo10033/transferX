<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRecipientRequest;
use App\Http\Resources\RecipientResource;
use Illuminate\Http\Request;
use App\Models\Recipient;

class AddRecipientController extends Controller
{

    public function __invoke(AddRecipientRequest $request)
    {

        // Create a new recipient instance
        $recipient = new Recipient;

        // Set each property individually
        $recipient->user_id = auth()->id();
        $recipient->name = $request->name;
        $recipient->number = $request->number;
        $recipient->provider = $request->provider;
        $recipient->bank_code = $request->bank_code;
        $recipient->type = $request->type;
        $recipient->currency = $request->currency;
        $recipient->country = $request->country;

        // Save the recipient
        $recipient->save();

        return $this->response(new RecipientResource($recipient));
    }
}
