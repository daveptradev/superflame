@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>

        <h2 class="text-3xl font-bold">
            Orders
        </h2>

        <p class="text-gray-500 mt-1">
            Monitor customer transactions
        </p>

    </div>

</div>

<div class="bg-[#111] border border-white/5 rounded-3xl overflow-hidden">

    <table class="w-full">

        <thead class="border-b border-white/5 bg-white/[0.02]">

            <tr class="text-left text-gray-400 text-sm">

                <th class="p-5">
                    Order ID
                </th>

                <th class="p-5">
                    Customer
                </th>

                <th class="p-5">
                    Total
                </th>

                <th class="p-5">
                    Payment
                </th>

                <th class="p-5">
                    Status
                </th>

                <th class="p-5">
                    Date
                </th>

                <th class="p-5">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($orders as $order)

            <tr class="border-b border-white/5 hover:bg-white/[0.02] transition">

                <!-- ORDER ID -->
                <td class="p-5 font-semibold">

                    {{ $order->midtrans_order_id }}

                </td>

                <!-- CUSTOMER -->
                <td class="p-5">

                    <div>

                        <p class="font-medium">
                            {{ $order->first_name }} {{ $order->last_name }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $order->email }}
                        </p>

                    </div>

                </td>

                <!-- TOTAL -->
                <td class="p-5 text-red-500 font-semibold">

                    IDR {{ number_format($order->total) }}

                </td>

                <!-- PAYMENT -->
                <td class="p-5">

                    @if($order->payment_status == 'paid')

                        <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-full text-xs uppercase">

                            Paid

                        </span>

                    @elseif($order->payment_status == 'pending')

                        <span class="bg-yellow-500/10 text-yellow-400 px-3 py-1 rounded-full text-xs uppercase">

                            Pending

                        </span>

                    @else

                        <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs uppercase">

                            {{ $order->payment_status }}

                        </span>

                    @endif

                </td>

                <!-- ORDER STATUS -->
                <td class="p-5">

                    @php

                        $statusColor = match($order->status) {

                            'completed' => 'bg-green-500/10 text-green-400',

                            'shipped' => 'bg-blue-500/10 text-blue-400',

                            'cancelled' => 'bg-red-500/10 text-red-400',

                            default => 'bg-yellow-500/10 text-yellow-400'
                        };

                    @endphp

                    <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs uppercase">

                        {{ $order->status }}

                    </span>

                </td>

                <!-- DATE -->
                <td class="p-5 text-gray-400">

                    {{ $order->created_at->format('d M Y') }}

                </td>

                <!-- ACTION -->
                <td class="p-5">

                    <a href="/admin/orders/{{ $order->id }}"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-sm transition">

                        View

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7"
                    class="p-10 text-center text-gray-500">

                    No orders yet

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection