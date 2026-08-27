<h2>SUPERFLAME</h2>

<p>Hi {{ $order->first_name }},</p>

<p>
Kami telah menerima pembayaran Anda.
Pesanan Anda sedang diproses oleh tim kami.
</p>

<p>
<b>Order ID:</b><br>
{{ $order->midtrans_order_id }}
</p>

<p>
<b>Total:</b><br>
IDR {{ number_format($order->total) }}
</p>

<p>
Status: Payment Successful
</p>

<p>
Terima kasih telah mendukung SUPERFLAME.
</p>

