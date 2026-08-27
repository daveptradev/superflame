@extends('layouts.app')

@section('title', 'Product Detail - Superflame')

@section('content')

<!-- BACK -->
<a href="/shop" 
   class="inline-flex items-center gap-2 ms-6 mt-4 text-sm text-gray-400 hover:text-red-500 transition">

  <svg xmlns="http://www.w3.org/2000/svg" 
       class="w-4 h-4" 
       fill="none" 
       viewBox="0 0 24 24" 
       stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
          d="M15 19l-7-7 7-7" />
  </svg>

  Back to Shop
</a>

<!-- PRODUCT DETAIL -->
<section class="px-8 py-10 grid md:grid-cols-2 gap-10">

<!-- IMAGE -->
<div class="w-full">

    <!-- ================= MOBILE SLIDER ================= -->
    <div class="md:hidden relative
        aspect-square overflow-hidden bg-[#f5f5f5]">

        <div id="mobileSlider"
            class="flex transition-transform duration-500 h-full">

            @foreach($product->images as $img)

            <img
                src="{{ asset('storage/' . $img->image) }}"

                class="w-full h-full
                object-cover flex-shrink-0"

                alt="{{ $product->name }}"
            >

            @endforeach

        </div>

        <!-- PREV -->
        <button onclick="prevSlide()"

            class="absolute left-3 top-1/2
            -translate-y-1/2

            w-9 h-9

            bg-black/40 text-white
            rounded-full">

            ‹

        </button>

        <!-- NEXT -->
        <button onclick="nextSlide()"

            class="absolute right-3 top-1/2
            -translate-y-1/2

            w-9 h-9

            bg-black/40 text-white
            rounded-full">

            ›

        </button>

    </div>

    <!-- ================= DESKTOP GALLERY ================= -->
    <div class="hidden md:block">

        <!-- MAIN IMAGE -->
        <div
    id="zoomContainer"
    
    class="group aspect-square
    overflow-hidden
    bg-[#f5f5f5]
    mb-4

    max-w-[650px]
    mx-auto

    cursor-crosshair"class="group aspect-square
    overflow-hidden
    bg-[#f5f5f5]
    mb-4

    max-w-[650px]
    mx-auto

    cursor-crosshair"

    class="group aspect-square
    overflow-hidden
    bg-[#f5f5f5]
    mb-4

    cursor-crosshair">

    <img
        id="mainImage"

        src="{{ asset('storage/' . $product->images->first()->image) }}"

        class="w-full h-full
        object-cover

        scale-00

        transition-transform duration-200 ease-out"
    >

</div>
        <!-- THUMBNAILS -->
        <div class="flex gap-3 justify-center max-w-[650px] mx-auto">

            @foreach($product->images as $img)

            <button
                onclick="changeImage('{{ asset('storage/' . $img->image) }}')"

                class="w-24 h-24
                overflow-hidden
                border border-gray-800
                hover:border-red-500
                transition">

                <img
                    src="{{ asset('storage/' . $img->image) }}"

                    class="w-full h-full object-cover"
                >

            </button>

            @endforeach

        </div>

    </div>

</div>

  <!-- INFO -->
  <div class="flex flex-col justify-center">

    <p class="text-xs tracking-[4px] text-gray-500 mb-2 uppercase">
      {{ $product->category }}
    </p>

    <h1 class="text-lg sm:text-xl md:text-4xl
font-bold
leading-tight
mb-4">
      {{ $product->name }}
    </h1>

    <div class="flex items-center gap-3 mb-6">

    @if($product->saleprice)

        <!-- Harga Asli -->
        <span class="text-gray-500 line-through text-xl">
            IDR {{ number_format($product->price, 0, ',', '.') }}
        </span>

        <!-- Harga Diskon -->
        <span class="text-red-500 font-bold text-3xl">
            IDR {{ number_format($product->saleprice, 0, ',', '.') }}
        </span>

    @else

        <!-- Harga Normal -->
        <span class="text-red-500 font-bold text-3xl">
            IDR {{ number_format($product->price, 0, ',', '.') }}
        </span>

    @endif

</div>


    <!-- SIZE -->
    <div class="mb-6">

      <div class="flex justify-between items-center mb-3">
        <p class="text-xs uppercase tracking-widest text-gray-400">
          Select Size
        </p>

        <button type="button" onclick="openSizeChart()" 
          class="text-xs text-gray-500 hover:text-red-500 underline">
          Size Guide
        </button>
      </div>

      <div class="flex gap-3 flex-wrap">
        @foreach($product->sizes as $size)

        <button
        
          onclick="selectSize(
            '{{ $size->size }}',
            {{ $size->stock }},
            this
            )"
        
          {{ $size->stock <= 0 ? 'disabled' : '' }}
        
          class="size-btn border border-red-700 px-5 py-2 text-xs
          rounded-lg transition
        
          {{ $size->stock <= 0
              ? 'opacity-30 cursor-not-allowed line-through'
              : 'hover:border-red-500'
          }}">
        
          {{ $size->size }}
        
          @if($size->stock <= 0)
        
          @endif
        
        </button>
        
        @endforeach
      </div>

    </div>

    <!-- ACTION -->
    <div class="space-y-4 mt-4">

      <div class="flex gap-3">

        <!-- QTY -->
        <div class="flex items-center border border-gray-700 rounded-full px-4 py-2">

          <button type="button" onclick="decreaseQty()" 
            class="text-gray-400 hover:text-red-500 text-lg">
            −
          </button>

          <span id="qty" class="mx-4 text-sm">1</span>

          <button type="button" onclick="increaseQty()" 
            class="text-gray-400 hover:text-red-500 text-lg">
            +
          </button>

        </div>
        
        <!-- WISHLIST -->
@php

$isWishlisted = false;

if(auth()->check()){

    $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
        ->where('product_id', $product->id)
        ->exists();
}

@endphp

<form
action="/wishlist/toggle/{{ $product->id }}"
method="POST">

@csrf

<button
class="w-12 h-12 rounded-full
border border-gray-700
flex items-center justify-center
text-white
hover:border-red-500
hover:text-red-500">

❤️

</button>

</form>

        <!-- ADD TO CART -->

        <form id="cart-form" action="/cart/add" method="POST" class="flex-1">
          @csrf

          <input type="hidden" name="id" value="{{ $product->id }}">
          <input type="hidden" name="name" value="{{ $product->name }}">
          <input
    type="hidden"
    name="price"

    value="{{ $product->saleprice
        ? $product->saleprice
        : $product->price }}"
>
          <input type="hidden" name="image" value="{{ $product->image }}">
          <input type="hidden" name="size" id="selected-size">
          <input type="hidden" name="qty" id="input-qty" value="1">

          <button id="addToCartBtn"
            disabled
            class="w-full bg-red-600 py-3 rounded-full font-semibold
            opacity-40 cursor-not-allowed hover:bg-red-700 transition">
        
            Add to Cart
        </button>

        </form>

      </div>

      <!-- BUY NOW -->
<button
id="buyNowBtn"
disabled
onclick="buyNow()"

class="w-full bg-red
border border-gray-700
py-3 rounded-full">

Buy It Now

</button>

</div>

    <!-- DESCRIPTION -->
    <div class="mt-1 border-t border-gray-800 pt-5">

    <div class="
        text-gray-300
        text-sm
        leading-[2]
        whitespace-pre-line
        max-w-xl
    ">

        {{ $product->description }}

    </div>

</div>

    

  
  
</section>

<!-- BUY NOW FORM -->
<form id="buy-now-form" action="/checkout/direct" method="POST">
  @csrf

  <input type="hidden" name="id" value="{{ $product->id }}">
  <input type="hidden" name="name" value="{{ $product->name }}">
  <input
    type="hidden"
    name="price"

    value="{{ $product->saleprice
        ? $product->saleprice
        : $product->price }}"
>
  <input type="hidden" name="image" value="{{ $product->image }}">
  <input type="hidden" name="size" id="buy-size">
  <input type="hidden" name="qty" id="buy-qty">

</form>

<!-- SIZE CHART MODAL -->
<div id="sizeChartOverlay" 
  class="fixed inset-0 bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition duration-300 z-50">

  <div class="flex items-center justify-center min-h-screen px-4">

    <div id="sizeChartBox"
      class="bg-[#0a0a0a] border border-gray-800 rounded-2xl p-6 max-w-md w-full
      transform scale-95 opacity-0 transition duration-300">

      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Size Guide</h2>

        <button onclick="closeSizeChart()" 
          class="text-gray-400 hover:text-red-500 text-xl">
          &times;
        </button>
      </div>

      @if($product->size_chart)

<img 
  src="{{ asset($product->size_chart) }}"
  class="w-full rounded-lg object-contain"
>

@endif

    </div>

  </div>

</div>

<script>

let currentIndex = 0;

const zoomContainer =
document.getElementById('zoomContainer');

const mainImage =
document.getElementById('mainImage');

if (zoomContainer && mainImage) {

    zoomContainer.addEventListener('mousemove', (e) => {

        const rect =
        zoomContainer.getBoundingClientRect();

        const x =
        ((e.clientX - rect.left) / rect.width) * 100;

        const y =
        ((e.clientY - rect.top) / rect.height) * 100;

        mainImage.style.transform =
        'scale(1.8)';

        mainImage.style.transformOrigin =
        `${x}% ${y}%`;

    });

    zoomContainer.addEventListener('mouseleave', () => {

        mainImage.style.transform =
        'scale(1)';

        mainImage.style.transformOrigin =
        'center center';

    });

}

const slider =
document.getElementById('mobileSlider');

function nextSlide() {

    currentIndex =
    (currentIndex + 1)
    % slider.children.length;

    slider.style.transform =
    `translateX(-${currentIndex * 100}%)`;
}

function prevSlide() {

    currentIndex =
    (currentIndex - 1 + slider.children.length)
    % slider.children.length;

    slider.style.transform =
    `translateX(-${currentIndex * 100}%)`;
}

function changeImage(src) {

    document
    .getElementById('mainImage')
    .src = src;
}

</script>



<!-- SIZE + QTY -->
<script>
let selectedSize = null;
let qty = 1;
let maxStock = 0;

function selectSize(size, stock, el) {

  selectedSize = size;
  maxStock = stock;

  document.getElementById('selected-size').value = size;

  document.querySelectorAll('.size-btn').forEach(btn => {
    btn.classList.remove('bg-red-600', 'text-white', 'border-red-500');
  });

  el.classList.add('bg-red-600', 'text-white', 'border-red-500');

  // ENABLE BUTTONS
  const addBtn = document.getElementById('addToCartBtn');
  const buyBtn = document.getElementById('buyNowBtn');

  addBtn.disabled = false;
  buyBtn.disabled = false;

  addBtn.classList.remove('opacity-40', 'cursor-not-allowed');
  buyBtn.classList.remove('opacity-40', 'cursor-not-allowed');
}

function increaseQty() {

  if (qty >= maxStock) {

    alert('Stock limit reached');

    return;
  }

  qty++;

  updateQty();
}

function decreaseQty() {
  if (qty > 1) qty--;
  updateQty();
}

function updateQty() {
  document.getElementById('qty').innerText = qty;
  document.getElementById('input-qty').value = qty;
}

function buyNow() {

  if (!selectedSize) {
    alert('Please select size first!');
    return;
  }

  document.getElementById('buy-size').value = selectedSize;
  document.getElementById('buy-qty').value = qty;

  document.getElementById('buy-now-form').submit();
}
</script>

<!-- SIZE GUIDE -->
<script>
function openSizeChart() {

  const overlay = document.getElementById('sizeChartOverlay');
  const box = document.getElementById('sizeChartBox');

  overlay.classList.remove('opacity-0', 'pointer-events-none');

  setTimeout(() => {
    box.classList.remove('scale-95', 'opacity-0');
  }, 50);
}

function closeSizeChart() {

  const overlay = document.getElementById('sizeChartOverlay');
  const box = document.getElementById('sizeChartBox');

  box.classList.add('scale-95', 'opacity-0');

  setTimeout(() => {
    overlay.classList.add('opacity-0', 'pointer-events-none');
  }, 200);
}

document.getElementById('sizeChartOverlay')
.addEventListener('click', function(e){

  if(e.target === this){
    closeSizeChart();
  }

});
</script>

<script>
function showLoginAlert() {

  alert('Silahkan login terlebih dahulu untuk melanjutkan pembelian.');

  window.location.href = '/login';
}
</script>


@endsection