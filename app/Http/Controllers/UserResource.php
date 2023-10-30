<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;


class UserResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'firstname'  => $this->firstname,
            'lastname'   => $this->lastname,
            'email'      => $this->email,
            'country'    => $this->country,
            'wallets'    => $this->wallets,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
