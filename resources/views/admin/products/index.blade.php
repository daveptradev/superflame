@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>
        <h2 class="text-3xl font-bold">
            Products
        </h2>

        <p class="text-gray-500 mt-1">
            Manage all Superflame products
        </p>
    </div>

    <button
        onclick="window.location.href='/admin/products/create'"
        class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold transition"> 

        + Add Product

    </button>

</div>

<!-- TABLE -->
<div class="bg-[#111] border border-white/5 rounded-3xl overflow-hidden">

    <table class="w-full">

        <thead class="border-b border-white/5 bg-white/[0.02]">

            <tr class="text-left text-gray-400 text-sm">

                <th class="p-5">Product</th>
                <th class="p-5">Category</th>
                <th class="p-5">Price</th>
                 <th class="p-5">Sale Price</th>
                <th class="p-5">Stock</th>
                <th class="p-5">Action</th>

            </tr>

        </thead>

        <tbody>

            

            @foreach($products as $product)

            <tr class="border-b border-white/5 hover:bg-white/[0.02] transition">

                <td class="p-5">

                    <div class="flex items-center gap-4">


                        <div class="w-14 h-14 rounded-2xl bg-[#1a1a1a]">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl">
                        </div>

                        <div>
                            <p class="font-semibold">
                                {{ $product->name }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ Str::limit($product->description, 50) }}
                            </p>
                        </div>

                    </div>

                </td>

                <td class="p-5 text-gray-300">
                    {{ $product->category }}
                </td>

                <td class="p-5 font-semibold text-white-500">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </td>
                
                <td class="p-5 font-semibold text-red-500">
                    Rp {{ number_format($product->saleprice, 0, ',', '.') }}
                </td>

                <td class="p-5">
                    <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-full text-xs">
                        {{ $product->stock }} in stock
                    </span>
                </td>

                <td class="p-5">

                    <div class="flex gap-3">

                        <button
                            onclick="window.location.href='/admin/products/{{ $product->id }}/edit'"
                            class="bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl text-sm transition">
                            Edit
                        </button>

                        <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="bg-red-500/10 hover:bg-red-500/20 text-red-400 px-4 py-2 rounded-xl text-sm transition">
                                Delete
                            </butto>
                        </form>

                    </div>

                </td>

            </tr>

            @endforeach

            

        </tbody>

    </table>

</div>

@endsection