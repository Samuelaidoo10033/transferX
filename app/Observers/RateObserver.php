<?php

namespace App\Observers;

use App\Models\Rate;

class RateObserver
{
    public function saving(Rate $rate): void
    {
        $rate->user_id = auth()->id();

        //todo move to request rule
        if($rate->from === $rate->to) {
            throw new \Exception('You can not exchange the same currency');
        }

        //disable all other rates for this currency pair
        if(!isset($rate->active) || $rate->active) {
            $rate->disableOtherRates();
        }
    }


    public function created(Rate $rate): void
    {
        //
    }

    /**
     * Handle the Rate "updated" event.
     */
    public function updated(Rate $rate): void
    {
        //
    }

    /**
     * Handle the Rate "deleted" event.
     */
    public function deleted(Rate $rate): void
    {
        //
    }

    /**
     * Handle the Rate "restored" event.
     */
    public function restored(Rate $rate): void
    {
        //
    }

    /**
     * Handle the Rate "force deleted" event.
     */
    public function forceDeleted(Rate $rate): void
    {
        //
    }
}
