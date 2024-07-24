<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class CoinGeckoService
{
    private $baseUrl = 'https://api.coingecko.com/api/v3';

    public function getExchangeRate()
    {
        try {
            $response = Http::get("{$this->baseUrl}/simple/price", [
                'ids' => 'bitcoin',
                'vs_currencies' => 'eur',
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw new Exception("Failed to fetch exchange rate.");
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
