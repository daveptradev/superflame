<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    protected $baseUrl;
    protected $key;

    public function __construct()
    {
        $this->baseUrl = "https://api.binderbyte.com/v1/";
        $this->key = env('BINDERBYTE_API_KEY');
    }

    // SEARCH LOCATION
    public function searchLocation($search)
    {
        return Http::get($this->baseUrl . "locations", [
            'search' => $search,
            'api_key' => $this->key
        ])->json();
    }

    // COST
   public function cost($origin, $destination, $weight, $courier)
{
    return Http::asForm()->post($this->baseUrl . "cost", [
        'api_key' => $this->key,
        'origin' => $origin,
        'destination' => $destination,
        'weight' => $weight,
        'courier' => $courier,
    ])->json();
}
}