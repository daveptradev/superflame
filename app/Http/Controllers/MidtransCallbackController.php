<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;
use App\Mail\ShippingTrackingMail;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK', $request->all());
        
        $serverKey = env('MIDTRANS_SERVER_KEY');

$hashed = hash(
    "sha512",
    $request->order_id .
    $request->status_code .
    $request->gross_amount .
    $serverKey
);

if ($hashed != $request->signature_key) {

    return response()->json([
        'message' => 'Invalid signature'
    ], 403);
}

        // =========================
        // GET DATA
        // =========================

        $orderId = $request->order_id;

        $transactionStatus =
            $request->transaction_status;

        $fraudStatus =
            $request->fraud_status;

        // =========================
        // FIND ORDER
        // =========================

        $order = Order::with('items')->where(
            'midtrans_order_id',
            $orderId
        )->first();

        if (!$order) {

            \Log::error('ORDER NOT FOUND', [
                'order_id' => $orderId
            ]);

            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        // =========================
        // SUCCESS
        // =========================

        if (

            $transactionStatus == 'capture'

            || $transactionStatus == 'settlement'
        ) {

            // CREDIT CARD FRAUD CHECK
            if (

                $transactionStatus == 'capture'

                && $fraudStatus != 'accept'
            ) {

                return response()->json([
                    'message' => 'Fraud detected'
                ]);
            }

            // JANGAN DOUBLE PROCESS
if ($order->payment_status != 'paid') {

    // UPDATE STATUS
    $order->update([

        'payment_status' => 'paid',

        'status' => 'paid'
    ]);
    
    Mail::to($order->email)
    ->send(
        new PaymentSuccessMail($order)
    );
    
    $this->createBiteshipOrder($order);

    // =========================
    // AUTO REDUCE STOCK
    // =========================

    foreach ($order->items as $item) {

        // FIND PRODUCT SIZE
        $productSize =
            \App\Models\ProductSize::where(

                'product_id',
                $item->product_id

            )->where(

                'size',
                $item->size

            )->first();

        // REDUCE SIZE STOCK
        if ($productSize) {

            $productSize->stock -= $item->qty;

            // PREVENT NEGATIVE
            if ($productSize->stock < 0) {

                $productSize->stock = 0;
            }

            $productSize->save();
        }

        // UPDATE TOTAL PRODUCT STOCK
        $product = \App\Models\Product::find(
            $item->product_id
        );

        if ($product) {

            $product->stock -= $item->qty;

            // PREVENT NEGATIVE
            if ($product->stock < 0) {

                $product->stock = 0;
            }

            $product->save();
        }
    }
}

        }

        // =========================
        // PENDING
        // =========================

        else if ($transactionStatus == 'pending') {

            $order->update([

                'payment_status' => 'pending',

                'status' => 'pending'
            ]);
        }

        // =========================
        // FAILED
        // =========================

        else if (

            $transactionStatus == 'deny'

            || $transactionStatus == 'expire'

            || $transactionStatus == 'cancel'
        ) {

            $order->update([

                'payment_status' => 'failed',

                'status' => 'cancelled'
            ]);
        }

        \Log::info('MIDTRANS UPDATED', [
            'order_id' => $orderId,
            'status' => $transactionStatus
        ]);

        return response()->json([
            'success' => true
        ]);
    }
    
    private function createBiteshipOrder($order)
{
    $items = [];

    foreach ($order->items as $item) {

        $items[] = [
            "name" => $item->product_name,
            "description" => "Size: {$item->size}",
            "value" => (int) $item->price,
            "quantity" => (int) $item->qty,
            "weight" => 1000,
        ];
    }
    
        // COURIER MAPPING
    $courierCompany =
    strtolower($order->courier);

    $courierType =
    strtolower($order->courier_service);

    try {

    $response = Http::withHeaders([
        'Authorization' => env('BITESHIP_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.biteship.com/v1/orders', [

    // SHIPPER
    "shipper_contact_name" => "SUPERFLAME",
    "shipper_contact_phone" => "085353910413",
    "shipper_contact_email" => "[email protected]",
    "shipper_organization" => "SUPERFLAME",

    // PICKUP
    "origin_contact_name" => "SUPERFLAME",
    "origin_contact_phone" => "085353910413",
    "origin_address" => "Jl. Gebang Lama E No.30 blok e, Jetis, Wedomartani, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584",
    "origin_postal_code" => 55584,

    // CUSTOMER
    "destination_contact_name" =>
        $order->first_name . ' ' . $order->last_name,

    "destination_contact_phone" =>
        $order->phone,

    "destination_address" =>
        $order->address,

    "destination_postal_code" =>
        $order->postal_code,

     // COURIER
    "courier_company" => $courierCompany,
    
    "courier_type" => $courierType,

    "delivery_type" => "now",

    // DELIVERY

    // ITEMS
    "items" => $items,

    // REFERENCE
    "reference_id" =>
    $order->midtrans_order_id . '-' . time(),
]);
    $data = $response->json();

    \Log::info('BITESHIP RESPONSE', [
        'status' => $response->status(),
        'body' => $data,
    ]);

    if (!$response->successful()) {

        \Log::error('BITESHIP ERROR', [
            'status' => $response->status(),
            'body' => $data,
        ]);
    }

    if ($response->successful()) {

    \Log::info('BITESHIP DATA', $data);

    $order->update([

        'biteship_order_id' =>

            $data['id']

            ?? $data['order_id']

            ?? null,

        'shipping_status' =>

            $data['status']

            ?? 'waiting_pickup',
    ]);
    
}

} catch (\Exception $e) {

    \Log::error('BITESHIP EXCEPTION', [
        'message' => $e->getMessage()
    ]);
}
}

public function biteshipWebhook(Request $request)
{
    \Log::info('BITESHIP WEBHOOK', $request->all());

    $biteshipOrderId =
        $request->order_id;

    $status =
        strtolower($request->status);

    $trackingNumber =
        $request->courier_waybill_id
        ?? $request->courier_tracking_id
        ?? null;

    $order = Order::where(
        'biteship_order_id',
        $biteshipOrderId
    )->first();

    if (!$order) {

        return response('ok', 200);
    }

    $order->update([

        'shipping_status' => $status,

        'tracking_number' =>
            $trackingNumber
            ?? $order->tracking_number,
    ]);
    
    // KIRIM EMAIL RESI HANYA SEKALI
    if (
        $trackingNumber
        &&
        !$order->tracking_email_sent
    ) {
    
        Mail::to($order->email)
            ->send(
                new ShippingTrackingMail(
                    $order->fresh()
                )
            );
    
        $order->update([
            'tracking_email_sent' => true
        ]);
    }

    if ($status == 'delivered') {

        $order->update([
            'status' => 'completed'
        ]);
    }

    return response('ok', 200);
}
       

}