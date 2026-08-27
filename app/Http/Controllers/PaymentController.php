<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', true);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order_id = uniqid('ORDER-');

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        // kirim juga cart biar bisa clear nanti
        return view('payment', compact('snapToken', 'order_id'));
    }

    // SUCCESS HANDLER
public function success()
{
    // 🔥 clear session
    session()->forget('direct_checkout');
    session()->forget('cart'); // optional

    return view('success');
}
}