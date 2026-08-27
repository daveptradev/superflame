<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;

class PaymentSuccessMail extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Payment Received - SUPERFLAME')
            ->view('emails.payment-success');
    }
}
