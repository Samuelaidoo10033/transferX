<?php

namespace App\Models;

use App\Enum\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $number
 * @property string $currency
 * @property string $country
 * @property float $balance
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static forUser(User $user, Currency $currency)
 */
class Wallet extends Model
{
    use HasFactory;

    public function scopeForUser($query, User $user, Currency $currency)
    {
        return $query->where('user_id', $user->id)
            ->where('currency', $currency->value);
    }
}
