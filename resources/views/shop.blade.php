@extends('layouts.app')

@section('title', 'Shop - Superflame')

@section('content')

<!-- HEADER -->
<section class="px-8 py-16 text-center">
    <h2 class="text-5xl font-extrabold mb-4">
        OUR COLLECTION
    </h2>

    <p class="text-gray-400">
        Official Merch & Limited Drops
    </p>
</section>



<!-- PRODUCTS -->
<section class="px-8 pb-16">

    @if($products->count() > 0)

    <div class="grid grid-cols-2 md:grid-cols-4
gap-x-4 gap-y-8 md:gap-8">

        @foreach($products as $product)

        <a href="/product/{{ $product->id }}"
    class="group block">

            <!-- IMAGE -->
                <div class="relative bg-gray-900
                    aspect-square
                    flex items-center justify-center
                    mb-3 md:mb-4
                    overflow-hidden rounded-2xl">
            
                    @if($product->stock <= 0)
            
                    <div class="absolute top-3 right-3 z-10
                        bg-red-600/95 backdrop-blur-md
                        border border-red-400/30
                        text-white text-[10px]
                        font-bold tracking-[3px]
                        px-4 py-1.5 rounded-full">
            
                        SOLD OUT
            
                    </div>
            
                    @endif
            
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            
                </div>
            

            <!-- PRODUCT INFO -->
            <h3 class="font-semibold text-sm md:text-lg">
                {{ $product->name }}
            </h3>

            <p class="text-gray-400 text-xs md:text-sm mb-2">

    @php
        $availableSizes = $product->sizes
            ->where('stock', '>', 0)
            ->pluck('size')
            ->implode(' • ');
    @endphp

    {{ $availableSizes ?: 'Sold Out' }}

</p>

            <!-- PRICE + BUTTON -->
            <div class="flex justify-between items-center">

<div class="flex items-center gap-2 flex-wrap">

    @if($product->saleprice)

        <!-- ORIGINAL PRICE -->
        <span class="text-gray-500 line-through
            text-[11px] md:text-sm leading-none">

            Rp {{ number_format($product->price, 0, ',', '.') }}

        </span>

        <!-- SALE PRICE -->
        <span class="text-red-500 font-medium
            text-[11px] md:text-sm leading-none">

            Rp {{ number_format($product->saleprice, 0, ',', '.') }}

        </span>

    @else

        <!-- NORMAL PRICE -->
        <span class="text-red-500 font-medium
            text-[11px] md:text-sm leading-none">

            Rp {{ number_format($product->price, 0, ',', '.') }}

        </span>

    @endif

</div>

            </div>

        </a>

        @endforeach

    </div>

    @else

    <!-- EMPTY -->
    <div class="text-center py-24">

        <h3 class="text-2xl font-bold text-white mb-3">
            No Products Found
        </h3>

        <p class="text-gray-500">
            Products will appear here soon.
        </p>

    </div>

    @endif

</section>

@endsection