<?php

namespace App\Http\Requests\Profile;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'sometimes|string',
            'lastname' => 'sometimes|string',
            'country' => 'sometimes|string',
        ];
    }

    public function execute()
    {

        $user = User::find($this->user()->id);

        if (!$user) {
            throw new Exception('User not found');
        }

        $user->update([
            'firstname' => $this->input('firstname'),
            'lastname' => $this->input('lastname'),
            'country' => $this->input('country'),
        ]);

        return $user;
    }
}
