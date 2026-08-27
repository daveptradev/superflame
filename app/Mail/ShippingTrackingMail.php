<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;

class ShippingTrackingMail extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Your Order Has Been Shipped')
            ->view('emails.shipping-tracking');
    }
}

