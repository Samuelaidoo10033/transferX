<?php

namespace App\Models;

use App\Enum\Currency;
use App\Enum\Destination;
use App\Enum\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property int $recipient_id
 * @property int $wallet_id
 * @property string $reference
 * @property string|null $provider_reference
 * @property string $recipient_name
 * @property string $recipient_number
 * @property string $recipient_provider
 * @property string $bank_code
 * @property string $payment_method
 * @property float $amount
 * @property float $rate
 * @property float $fee
 * @property Currency $from
 * @property Currency $to
 * @property TransactionStatus $status
 * @property Destination $destination
 * @property array|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Recipient $recipient
 * @property-read User $user
 * @property-read Wallet $wallet
 * @method static forUser($userId = null)
 *
 */
class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'metadata' => 'array',
    ];
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Recipient::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setMeta($key, $value): void
    {
        // Get the current metadata
        $metadata = $this->metadata;

        // Set the new value for the provided key
        data_set($metadata, $key, $value);

        // Update the model's metadata
        $this->metadata = $metadata;

    }

    public function getMeta( $key, $default = null): ?string
    {
        // get the value from the metadata using data_get
        return data_get($this->metadata, $key, $default);
    }

    public function cancel()
    {
        $this->status = TransactionStatus::CANCELLED->value;
        $this->setMeta('cancelled_at', Carbon::now());
        $this->save();
    }

    public function scopeForUser($query, $userId = null)
    {
        if(empty($userId))
        {
            $userId = auth()->id();
        }
        return $query->where('user_id', $userId);
    }

    public function getAmountToSendAttribute()
    {
        return ($this->amount * $this->rate) - $this->fee;
    }

    public function getReasonAttribute(): ?string
    {
        return $this->getMeta('reason');
    }

    public function setReasonAttribute($reason): void
    {
        $this->setMeta('reason', $reason);
    }


}
