@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold mb-8">
        Edit Product
    </h1>

    <form action="/admin/products/{{ $product->id }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf
        @method('PUT')

        <!-- NAME -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Product Name
            </label>

            <input type="text"
                name="name"
                value="{{ $product->name }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- PRICE -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Price
            </label>

            <input type="number"
                name="price"
                value="{{ $product->price }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
                
            <label class="block mb-2 text-sm text-gray-400">
                Price Diskon
            </label>

            <input type="number"
                name="saleprice"
                value="{{ $product->saleprice }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">


        </div>

        <!-- CATEGORY -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Category
            </label>

            <input type="text"
                name="category"
                value="{{ $product->category }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- SIZE STOCK -->
<div>

    <label class="block mb-4 text-sm text-gray-400">
        Product Sizes & Stock
    </label>

    @php
        $sizes = [];

        foreach ($product->sizes as $s) {
            $sizes[$s->size] = $s->stock;
        }
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <!-- S -->
        <div>
            <label class="text-xs text-gray-500 mb-2 block">
                Size S
            </label>

            <input type="number"
                name="sizes[S]"
                value="{{ $sizes['S'] ?? 0 }}"
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
                value="{{ $sizes['M'] ?? 0 }}"
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
                value="{{ $sizes['L'] ?? 0 }}"
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
                value="{{ $sizes['XL'] ?? 0 }}"
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
                value="{{ $sizes['XXL'] ?? 0 }}"
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
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">{{ $product->description }}</textarea>

        </div>
        
        <!-- CURRENT SIZE CHART -->
        @if($product->size_chart)
        
        <div>
        
            <label class="block mb-3 text-sm text-gray-400">
                Current Size Chart
            </label>
        
            <img
                src="{{ asset($product->size_chart) }}"
                class="w-64 rounded-2xl border border-white/10">
        
        </div>
        
        @endif
        
        <!-- REPLACE SIZE CHART -->
        <div>
        
            <label class="block mb-2 text-sm text-gray-400">
                Replace Size Chart
            </label>
        
            <input type="file"
                name="size_chart"
                class="w-full bg-[#111]
                border border-white/10
                rounded-2xl px-5 py-4">
        
        </div>

        <!-- CURRENT COVER -->
        <div>

            <label class="block mb-3 text-sm text-gray-400">
                Current Cover
            </label>

            <img src="{{ asset('storage/' . $product->image) }}"
                class="w-40 rounded-2xl border border-white/10">

        </div>

        <!-- NEW COVER -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Replace Cover
            </label>

            <input type="file"
                name="image"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- CURRENT GALLERY -->
<div>

    <label class="block mb-3 text-sm text-gray-400">
        Gallery Images
    </label>

    <div class="grid grid-cols-4 gap-4">

        @foreach($product->images as $img)

        <div class="relative group">

            <!-- IMAGE -->
            <img src="{{ asset('storage/' . $img->image) }}"
                class="rounded-2xl border border-white/10 h-32 object-cover w-full">
                
            <button
    type="button"

    onclick="deleteGallery({{ $img->id }})"

    class="absolute top-2 right-2
    bg-black/70 hover:bg-red-600
    w-8 h-8 rounded-full
    flex items-center justify-center
    opacity-0 group-hover:opacity-100
    transition duration-200">

    ×

</button>

            

        </div>

        @endforeach

    </div>

</div>

        <!-- ADD NEW GALLERY -->
        <div>

            <label class="block mt-4 mb-2 text-sm text-gray-400">
                Add Gallery Images
            </label>

            <input type="file"
                name="gallery[]"
                multiple
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <button
            class="mt-8 bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition">

            Update Product

        </button>

    </form>

</div>

<script>

function deleteGallery(id)
{
    if (!confirm('Delete this image?')) {
        return;
    }

    fetch(`/admin/products/gallery/${id}`, {

        method: 'DELETE',

        headers: {

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}',

            'Accept':
                'application/json'
        }

    })
    .then(() => {

        location.reload();

    })
    .catch(err => {

        console.log(err);

        alert('Failed to delete image');
    });
}

</script>

@endsection