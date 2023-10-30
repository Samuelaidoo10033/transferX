<?php

namespace App\Http\Controllers;

use App\Models\Recipient;

class DeleteRecipientController extends Controller
{
    public function __invoke($id)
    {
        $recipient = Recipient::findOrFail($id);

        if($recipient->user_id !== auth()->id()) {
            return response()->json(['message' => 'You are not authorized to delete this recipient'], 403);
        }

        $recipient->delete();

        return response()->json(['message' => 'Recipient deleted successfully']);
    }
}
