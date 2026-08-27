@extends('layouts.admin')

@section('content')

<div class="max-w-3xl">

    <h1 class="text-3xl font-bold mb-8">
        Add Product
    </h1>

    <form action="/admin/products" method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        <!-- NAME -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Product Name
            </label>

            <input type="text" name="name"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- PRICE -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Price
            </label>

            <input type="number" name="price"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>
        
        <!-- diskon -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Sale Price
            </label>

            <input type="number" name="saleprice"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- CATEGORY -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Category
            </label>

            <input type="text" name="category"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- SIZE STOCK -->
<div>

    <label class="block mb-4 text-sm text-gray-400">
        Product Sizes & Stock
    </label>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <!-- S -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size S
            </label>

            <input type="number"
                name="sizes[S]"
                value="0"
                min="0"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- M -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size M
            </label>

            <input type="number"
                name="sizes[M]"
                value="0"
                min="0"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- L -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size L
            </label>

            <input type="number"
                name="sizes[L]"
                value="0"
                min="0"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <!-- XL -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size XL
            </label>

            <input type="number"
                name="sizes[XL]"
                value="0"
                min="0"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>
        
        <!-- XXL -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size XXL
            </label>
        
            <input type="number"
                name="sizes[XXL]"
                value="0"
                min="0"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

    </div>

</div>

        <!-- DESCRIPTION -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Description
            </label>

            <textarea name="description"
                rows="5"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4"></textarea>
        </div>
        
        <!-- SIZE CHART -->
        <div>
        
            <label class="block mb-2 text-sm text-gray-400">
                Size Chart
            </label>
        
            <input type="file"
                name="size_chart"
                class="w-full bg-[#111]
                border border-white/10
                rounded-2xl px-5 py-4">
        
        </div>

        <!-- IMAGE -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Product Image
            </label>

            <input type="file" name="image" 
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Product Gallery
            </label>

            <input type="file" name="gallery[]" multiple
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        </div>

        <button
            class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition">

            Save Product

        </button>

    </form>

</div>

@endsection