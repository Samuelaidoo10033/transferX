<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property string number
 * @property string provider
 * @property string bank_code
 * @property string currency
 * @property string country
 * @property string type
 */
class AddRecipientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'number' => 'required|string',
            'provider' => 'required|string',
            'bank_code' => 'nullable|string',
            'type' => 'required|string',
            'currency' => 'required|string',
            'country' => 'required|string',
        ];
    }
}
