<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'recipient_id' => $this->recipient_id,
            'wallet_id' => $this->wallet_id,
            'reference' => $this->reference,
            'provider_reference' => $this->provider_reference,
            'recipient_name' => $this->recipient_name,
            'recipient_number' => $this->recipient_number,
            'recipient_provider' => $this->recipientprovider,
            'bank_code' => $this->bank_code,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'rate' => $this->rate,
            'fee' => $this->fee,
            'from' => $this->from,
            'to' => $this->to,
            'status' => $this->status,
            'destination' => $this->destination,
            'metadata' => $this->metadata,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
