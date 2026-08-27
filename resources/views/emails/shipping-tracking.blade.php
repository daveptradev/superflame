<h2>SUPERFLAME</h2>

<p>Hi {{ $order->first_name }},</p>

<p>
Pesanan Anda telah dikirim.
</p>

<p>
<b>Order ID:</b><br>
{{ $order->midtrans_order_id }}
</p>

<p>
<b>Courier:</b><br>
{{ strtoupper($order->courier) }}
</p>

<p>
<b>Tracking Number:</b><br>
{{ $order->tracking_number }}
</p>

<p>
Status:
{{ ucfirst($order->shipping_status) }}
</p>

<p>
Terima kasih telah berbelanja di SUPERFLAME.
</p>

