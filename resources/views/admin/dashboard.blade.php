@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="mb-10">

    <h1 class="text-2xl md:text-4xl font-bold">
        Dashboard
    </h1>

    <p class="text-gray-500 mt-2">
        Superflame CMS Overview
    </p>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

    <!-- PRODUCTS -->
    <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

        <p class="text-gray-500 text-sm">
            Products
        </p>

        <h2 class="text-3xl md:text-4xl font-bold mt-3">
            {{ $totalProducts }}
        </h2>

    </div>

    <!-- ORDERS -->
    <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

        <p class="text-gray-500 text-sm">
            Orders
        </p>

       <h2 class="text-3xl md:text-4xl font-bold mt-3">
            {{ $totalOrders }}
        </h2>

    </div>

    <!-- REVENUE -->
    <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

        <p class="text-gray-500 text-sm">
            Revenue
        </p>

        <h2 class="text-3xl font-bold mt-3 text-red-500">
            IDR {{ number_format($totalRevenue) }}
        </h2>

    </div>

    <!-- LIVESETS -->
    <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

        <p class="text-gray-500 text-sm">
            Livesets
        </p>

        <h2 class="text-3xl md:text-4xl font-bold mt-3">
            {{ $totalLivesets }}
        </h2>

    </div>

</div>

<!-- SECOND ROW -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- LATEST ORDERS -->
    <div class="xl:col-span-2 bg-[#111] border border-white/5 rounded-3xl p-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Latest Orders
            </h2>

            <a href="/admin/orders"
                class="text-sm text-red-500 hover:text-red-400">

                View All

            </a>

        </div>

        <div class="space-y-4">

            @forelse($latestOrders as $order)

            <div class="flex items-center justify-between
                border border-white/5 rounded-2xl p-4">

                <div>

                    <p class="font-semibold">
                        {{ $order->first_name }} {{ $order->last_name }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $order->email }}
                    </p>

                </div>

                <div class="text-right">

                    <p class="text-red-500 font-semibold">
                        IDR {{ number_format($order->total) }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1 uppercase">
                        {{ $order->payment_status }}
                    </p>

                </div>

            </div>

            @empty

            <p class="text-gray-500">
                No orders yet
            </p>

            @endforelse

        </div>

    </div>

    <!-- LATEST PRODUCTS -->
    <div class="bg-[#111] border border-white/5 rounded-3xl p-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Latest Products
            </h2>

            <a href="/admin/products"
                class="text-sm text-red-500 hover:text-red-400">

                View All

            </a>

        </div>

        <div class="space-y-4">

            @forelse($latestProducts as $product)

            <div class="flex items-center gap-4">

                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-16 h-16 rounded-2xl object-cover">

                <div>

                    <p class="font-semibold">
                        {{ $product->name }}
                    </p>

                    <p class="text-red-500 text-sm mt-1">
                        IDR {{ number_format($product->price) }}
                    </p>

                </div>

            </div>

            @empty

            <p class="text-gray-500">
                No products yet
            </p>

            @endforelse

        </div>

    </div>

</div>

@endsection