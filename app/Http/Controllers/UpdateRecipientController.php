<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRecipientRequest;
use App\Models\Recipient;

class UpdateRecipientController extends Controller
{
    public function __invoke(UpdateRecipientRequest $request, $id)
    {
        $data = $request->validated();
        $recipient = Recipient::findOrFail($id);

        if($recipient->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $recipient->update($data);

        return response()->json($recipient);
    }
}
