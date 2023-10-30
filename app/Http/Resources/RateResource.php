<?php

namespace App\Http\Resources;

use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $user_id
 * @property bool $active
 * @property float $amount
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property float $converted_amount
 */
class RateResource extends JsonResource
{
    public ?float $converted_amount;
    public ?float $from_amount;

    public bool $reverse;

    public function __construct(Rate $resource,float $fromAmount = null, float $convertedAmount = null, bool $reverse = false)
    {
        parent::__construct($resource);
        $this->from_amount = $fromAmount;
        $this->converted_amount = $convertedAmount;
        $this->reverse = $reverse;
    }

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'amount' => $this->from_amount,
            'rate' => $this->amount,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'converted_amount' => $this->converted_amount,
            'reverse' => $this->reverse
        ];
    }
}
