<?php

namespace App\Actions;

use App\Models\Transaction;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method run(): string
 */
class GetTransactionReferenceAction
{
    use AsAction;

    public function handle(): string
    {
        do {
            // Generate a unique ID with "TX" prefix
            $reference = 'TX' . uniqid();
        }
            // Check if the ID already exists in the 'reference' field
        while (Transaction::where('reference', $reference)->exists());

        // Return the unique ID
        return strtoupper($reference);

    }
}
