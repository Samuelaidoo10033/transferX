<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $user_id
 * @property bool $active
 * @property float $amount
 * @method Builder|Rate disableOtherRates()
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Rate extends Model
{
    use HasFactory;

    protected $guarded = [];

    // disable all other rates for this currency pair using a scope
    public function scopeDisableOtherRates(Builder $query): int
    {
        return $query->where('from', $this->from)
            ->where('to', $this->to)
            ->where('id', '!=', $this->id)
            ->update(['active' => false]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
