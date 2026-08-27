<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function calculate(Request $request)
    {
    
    // DEFAULT COURIER
    $couriers = "jne,jnt";
    
    $response = Http::withHeaders([

    'Authorization' => env('BITESHIP_API_KEY'),

    'Content-Type' => 'application/json',

])->post(
    'https://api.biteship.com/v1/rates/couriers', [

            "origin_postal_code" => "55584",
            
            "origin_latitude" => -7.7527,

            "origin_longitude" => 110.4348,

            "destination_postal_code" =>
                $request->destination_postal_code,

            "couriers" => $couriers,

            "items" => [

                [
                    "name" => "Superflame Product",
                    "description" => "Streetwear",
                    "value" => 300000,
                    "length" => 20,
                    "width" => 20,
                    "height" => 5,
                    "weight" => 200,
                    "quantity" => 1
                ]

            ]

        ]);

        return response()->json(
    $response->json()
);
        
    }
}