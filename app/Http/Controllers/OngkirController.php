<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ShippingService;

class ShippingController extends Controller{

    public function index()
    {
        return view('cek-ongkir');
    }

    public function cek(Request $request)
    {
        $response = Http::get('https://api.binderbyte.com/v1/cost', [
            'api_key' => env('BINDERBYTE_API_KEY'),
            'courier' => $request->courier,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
        ]);

        $hasil = $response->json();

        return view('cek-ongkir', ['hasil' => $hasil]);
    }
}