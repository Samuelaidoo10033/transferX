<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BankListController extends Controller
{
    public function __invoke()
    {
        $country = request()->input('country', 'NG');
        $banks = $this->getBanks($country);

        return $this->response($banks, "List of banks in {$country} retrieved successfully");

    }

    public function getBanks(string $country = 'NG'): array
    {
        $cacheKey = "bank-list-{$country}";

        return Cache::remember($cacheKey, config('cache.cache_expiry'), function () use ($country) {
            $baseurl = config('services.flutterwave.baseurl');
            $seckey = config('services.flutterwave.secretkey');

            $response = Http::withToken($seckey)->get("{$baseurl}/banks/{$country}");
            $response->throw();

            return $response->json()['data'];
        });
    }
}

