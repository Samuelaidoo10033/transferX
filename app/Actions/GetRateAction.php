<?php

namespace App\Actions;

use App\Enum\Currency;
use App\Models\Rate;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method run(Currency $from, Currency $to): Rate
 *
 */

class GetRateAction
{
    use AsAction;

    public function handle(Currency $from, Currency $to): Rate
    {
        $rate = Rate::where('from', $from->value)
            ->where('to', $to->value)
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$rate) {
            throw new \Exception('Rate not found');
        }

        return $rate;
    }

}
