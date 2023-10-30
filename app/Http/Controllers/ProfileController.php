<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index(ProfileRequest $request)
    {
        $user = $request->execute();

        $resp = new UserResource($user);

        return $this->response($resp, 'Successful');

    }

    public function update(UpdateProfileRequest $request)
    {

        try {
            $user = $request->execute();

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->response($user, 'Profile updated');

    }
}
