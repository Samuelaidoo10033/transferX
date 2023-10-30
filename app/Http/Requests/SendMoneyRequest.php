<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed recipient_id
 * @property mixed amount
 * @property mixed from_currency
 * @property mixed to_currency
 * @property mixed payment_method
 * @property mixed destination
 */
class SendMoneyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recipient_id' => 'required|exists:recipients,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:wallet,bank_transfer,mobile_money',
            'from_currency' => 'required|string',
            'to_currency' => 'required|string',
            'destination' => 'required|string',
        ];
    }


}
