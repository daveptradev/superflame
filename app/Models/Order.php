<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        // USER
        'user_id',

        // CUSTOMER
        'email',
        'first_name',
        'last_name',
        'phone',

        // ADDRESS
        'address',
        'province',
        'postal_code',

        // SHIPPING
        'courier',
        'courier_service',
        'shipping_cost',
        'biteship_order_id',
        'tracking_number',
        'shipping_status',
        'tracking_email_sent',
        'delivery_type',

        // PAYMENT
        'payment_status',
        'status',
        'midtrans_order_id',

        // PRICE
        'subtotal',
        'total',
    ];

    // =========================
    // RELATION
    // =========================

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}