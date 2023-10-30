<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __invoke(RateRequest $request)
    {
        $fromCurrency = $request['from'];
        $toCurrency = $request['to'];
        $amount = $request['amount'];

        $rate = Rate::where('from', $fromCurrency)
            ->where('to', $toCurrency)
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$rate) {
            return response()->json(['error' => 'Conversion rate not found.'], 404);
        }

        // Check if reverse conversion is requested
        if ($request->has('reverse') && $request->input('reverse') == true) {
            // Find the inverse conversion rate
            $inverseRate = Rate::where('from', $toCurrency)
                ->where('to', $fromCurrency)
                ->where('active', 1)
                ->orderBy('created_at', 'desc')
                ->first();

            // If the inverse rate exists, calculate the inverse converted amount
            if ($inverseRate) {
                $convertedAmount = round($amount / $inverseRate->amount, 2);
            } else {
                // If the inverse rate doesn't exist, return an error response
                return response()->json(['error' => 'Inverse conversion rate not found.'], 404);
            }
        } else {
            // Perform the default direct conversion
            $convertedAmount = round($amount * $rate->amount, 2);
        }

        $data = new RateResource($rate, $amount, $convertedAmount);

        return response()->json([
            "message" => "Conversion successful",
            "data" => $data
        ]);
    }

}
