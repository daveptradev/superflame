@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Order Detail
        </h1>

        <p class="text-gray-500 mt-2">
            {{ $order->midtrans_order_id }}
        </p>

    </div>

    <!-- STATUS UPDATE -->
    <form action="/admin/orders/{{ $order->id }}"
        method="POST"
        class="flex items-center gap-4">

        @csrf
        @method('PUT')

        <select
            name="status"
            class="bg-[#111] border border-white/10 rounded-2xl px-5 py-3">

            <option value="pending"
                {{ $order->status == 'pending' ? 'selected' : '' }}>

                Pending

            </option>

            <option value="paid"
                {{ $order->status == 'paid' ? 'selected' : '' }}>

                Paid

            </option>

            <option value="shipped"
                {{ $order->status == 'shipped' ? 'selected' : '' }}>

                Shipped

            </option>

            <option value="completed"
                {{ $order->status == 'completed' ? 'selected' : '' }}>

                Completed

            </option>

            <option value="cancelled"
                {{ $order->status == 'cancelled' ? 'selected' : '' }}>

                Cancelled

            </option>

        </select>

        <button
            class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold">

            Update

        </button>

    </form>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="xl:col-span-2 space-y-6">

        <!-- ITEMS -->
        <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

            <h2 class="text-2xl font-bold mb-6">
                Order Items
            </h2>

            <div class="space-y-5">

                @foreach($order->items as $item)

                <div class="flex items-center justify-between
                    border border-white/5 rounded-2xl p-4">

                    <div class="flex items-center gap-4">

                        <!-- IMAGE -->
                        <img src="{{ asset($item->image) }}"
                            class="w-20 h-20 rounded-2xl object-cover">

                        <!-- INFO -->
                        <div>

                            <p class="font-semibold text-lg">
                                {{ $item->product_name }}
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Size: {{ $item->size }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Qty: {{ $item->qty }}
                            </p>

                        </div>

                    </div>

                    <!-- PRICE -->
                    <p class="text-red-500 font-semibold text-lg">

                        IDR {{ number_format($item->price * $item->qty) }}

                    </p>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="space-y-6">

        <!-- CUSTOMER -->
        <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

            <h2 class="text-2xl font-bold mb-6">
                Customer
            </h2>

            <div class="space-y-4 text-sm">

                <div>

                    <p class="text-gray-500 mb-1">
                        Full Name
                    </p>

                    <p class="font-semibold">
                        {{ $order->first_name }} {{ $order->last_name }}
                    </p>

                </div>

                <div>

                    <p class="text-gray-500 mb-1">
                        Email
                    </p>

                    <p>
                        {{ $order->email }}
                    </p>

                </div>

                <div>

                    <p class="text-gray-500 mb-1">
                        Phone
                    </p>

                    <p>
                        {{ $order->phone }}
                    </p>

                </div>

            </div>

        </div>

        <!-- SHIPPING -->
        <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

            <h2 class="text-2xl font-bold mb-6">
                Shipping
            </h2>

            <div class="space-y-4 text-sm">

                <div>

                    <p class="text-gray-500 mb-1">
                        Address
                    </p>

                    <p>
                        {{ $order->address }}
                    </p>

                </div>

                <div>

                    <p class="text-gray-500 mb-1">
                        Province
                    </p>

                    <p>
                        {{ $order->province }}
                    </p>

                </div>

                <div>

                    <p class="text-gray-500 mb-1">
                        Postal Code
                    </p>

                    <p>
                        {{ $order->postal_code }}
                    </p>

                </div>
                
                <div>
                
                    <p class="text-gray-500 mb-1">
                        Courier
                    </p>
                
                    <p class="uppercase">
                        {{ $order->courier }}
                        {{ $order->courier_service }}
                    </p>
                
                </div>
                
                <div>
                
                    <p class="text-gray-500 mb-1">
                        Tracking Number
                    </p>
                
                    <p class="font-semibold text-green-400">
                        {{ $order->tracking_number ?? '-' }}
                    </p>
                
                </div>
                
                <div>
                
                    <p class="text-gray-500 mb-1">
                        Shipping Status
                    </p>
                
                    <span class="bg-blue-500/10 text-blue-400
                        px-3 py-1 rounded-full text-xs uppercase">
                
                        {{ $order->shipping_status ?? 'pending' }}
                
                    </span>
                
                </div>
                
                <div>
                
                    <p class="text-gray-500 mb-1">
                        Biteship Order ID
                    </p>
                
                    <p class="text-xs break-all">
                        {{ $order->biteship_order_id ?? '-' }}
                    </p>
                
                </div>

            </div>

        </div>

        <!-- PAYMENT -->
        <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

            <h2 class="text-2xl font-bold mb-6">
                Payment
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Subtotal
                    </span>

                    <span>
                        IDR {{ number_format($order->subtotal) }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Shipping
                    </span>

                    <span>
                        IDR {{ number_format($order->shipping_cost) }}
                    </span>

                </div>

                <div class="border-t border-white/5 pt-4 flex justify-between
                    text-lg font-bold">

                    <span>
                        Total
                    </span>

                    <span class="text-red-500">
                        IDR {{ number_format($order->total) }}
                    </span>

                </div>

                <!-- PAYMENT STATUS -->
                <div class="pt-4">

                    <span class="bg-white/5 px-4 py-2 rounded-full
                        text-xs uppercase">

                        {{ $order->payment_status }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection