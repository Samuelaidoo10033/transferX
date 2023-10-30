<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Models\Accounts;
use Illuminate\Http\Request;

class UpdateAccountController extends Controller
{
    public function __invoke(UpdateAccountRequest $request, $id)
    {
        $data = $request->validated();
        $recipient = Accounts::findOrFail($id);

        if($recipient->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $recipient->update($data);

        return response()->json($recipient);

    }
}
