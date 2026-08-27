<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="UTF-8">

  <meta name="facebook-domain-verification"
        content="2y2n0u8i4b33u4ia1y3vxy55ydvhw5" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title', 'Superflame Live')</title>

<!-- FAVICON -->
<link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

<script src="https://cdn.tailwindcss.com"></script>
 

  <style>
    body {
      background-color: #0a0a0a;
    }

.nav-link {
  position: relative;
  color: rgba(255,255,255,0.9);
  font-weight: 600;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}

.nav-link::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -8px;
  width: 0;
  height: 2px;
  border-radius: 999px;
  background: #ef4444;

  transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);

  transform: translateX(-50%);
}

.nav-link:hover {
  color: #ef4444;
}

.nav-link:hover::after {
  width: 100%;
}

.nav-link.active::after {
  width: 100%;
}
  </style>

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<!-- OVERLAY -->
<div id="cartOverlay"
  class="fixed inset-0 bg-black/70 hidden z-[10000]">
</div>

<!-- DRAWER -->
<div id="cartDrawer" 
  class="fixed top-0 right-0 h-full w-80 max-w-full
  bg-[#0a0a0a] shadow-2xl
  transform translate-x-full transition-transform duration-300
  z-[10001] flex flex-col">

  <!-- HEADER -->
  <div class="flex justify-between items-center p-4 border-b border-gray-800">
    <h2 class="text-white text-lg font-semibold">CART</h2>
    <button onclick="closeCart()" class="text-white hover:text-red-500 text-xl">&times;</button>
  </div>

  <!-- CONTENT -->
  <div class="flex-1 overflow-y-auto p-4 space-y-4 text-white">

    @if(count($cart) > 0)

      @foreach($cart as $index => $item)
      <div class="border-b border-gray-800 pb-4 flex gap-4 items-start">

        <!-- IMAGE -->
        <img 
    src="{{ asset('storage/' . $item['image']) }}"
    alt="{{ $item['name'] }}"
    class="w-16 h-16 object-cover rounded">

             

        <!-- INFO -->
        <div class="flex-1">

          <p class="font-semibold text-sm">{{ $item['name'] }}</p>
          <p class="text-xs text-gray-400">Size: {{ $item['size'] }}</p>

          <!-- QTY -->
          <div class="flex items-center gap-2 mt-2">

            <!-- MINUS -->
            <form action="/cart/update/{{ $index }}" method="POST">
              @csrf
              <input type="hidden" name="change" value="-1">
              <button class="px-2 bg-gray-800 hover:bg-red-500">-</button>
            </form>

            <span>{{ $item['qty'] }}</span>

            <!-- PLUS -->
            <form action="/cart/update/{{ $index }}" method="POST">
              @csrf
              <input type="hidden" name="change" value="1">
              <button class="px-2 bg-gray-800 hover:bg-red-500">+</button>
            </form>

          </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="flex flex-col items-end gap-2">

          <!-- PRICE -->
          <p class="text-red-500 text-sm">
            IDR {{ number_format($item['price'] * $item['qty']) }}
          </p>

          <!-- REMOVE -->
          <form action="/cart/remove/{{ $index }}" method="POST">
            @csrf
            <button class="text-gray-400 hover:text-red-500 text-lg">
              &times;
            </button>
          </form>

        </div>

      </div>
      @endforeach

    @else

    <!-- EMPTY -->
    <div class="flex flex-col items-center justify-center h-full text-sm space-y-4">

      <svg xmlns="http://www.w3.org/2000/svg" 
        class="h-10 opacity-50"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
          d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
      </svg>

      <p class="opacity-70">Your cart is empty</p>

      <button 
        onclick="window.location.href='/shop'"
        class="bg-red-600 px-5 py-2 rounded-lg text-sm hover:bg-red-700">
        Continue Shopping
      </button>

    </div>

    @endif

  </div>

  <!-- FOOTER -->
  @if(count($cart) > 0)
  <div class="p-4 border-t border-gray-800 bg-[#0a0a0a] shadow-[0_-5px_15px_rgba(0,0,0,0.5)]">

    @php
      $total = 0;
      foreach($cart as $item){
          $total += $item['price'] * $item['qty'];
      }
    @endphp

    <div class="flex justify-between mb-4 text-sm">
      <span>Total</span>
      <span class="text-red-500 font-semibold">
        IDR {{ number_format($total) }}
      </span>
    </div>

    <button 
      onclick="window.location.href='/checkout?from_cart=1'"
      class="w-full bg-red-600 py-2 rounded-lg hover:bg-red-700">
      Checkout
    </button>

  </div>
  @endif

</div>
<body class="text-white font-sans">
<nav class="
fixed top-0 left-0 w-full
z-[9999]
flex items-center justify-between
px-4 md:px-8 py-4

bg-black/40
backdrop-blur-2xl

border-b border-white/10
shadow-[0_8px_30px_rgba(0,0,0,0.4)]

transition-all duration-300
"> 

  <!-- LEFT: LOGO -->
  <!-- MOBILE MENU BUTTON -->
<button
  onclick="toggleMobileMenu()"
  class="md:hidden text-white hover:text-red-500 transition">

  <svg xmlns="http://www.w3.org/2000/svg"
    class="h-8 w-8"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor">

    <path stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="1.8"
      d="M4 6h16M4 12h16M4 18h16"/>
  </svg>

</button>
  <div class="flex-shrink-0">
    <a href="/">
      <img src="{{ asset('assets/sflamered.png') }}" class="h-16">
    </a>
  </div>

  <!-- CENTER: MENU -->
  <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 space-x-8 text-lg">

    <a href="/" class="nav-link {{ request()->is('/') ? 'text-red-500' : '' }} ">HOME</a>
    <a href="/sessions" class="nav-link {{ request()->is('sessions') ? 'text-red-500' : '' }}">SESSIONS</a>
<div class="relative group">

  <!-- BUTTON -->
  <button class="nav-link {{ request()->is('shop*') ? 'text-red-500' : '' }} flex items-center gap-2 font-semibold tracking-wide">

    SHOP

    <svg xmlns="http://www.w3.org/2000/svg"
      class="w-4 h-4 transition duration-300 group-hover:rotate-180"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor">

      <path stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M19 9l-7 7-7-7"/>
    </svg>

  </button>

  <!-- DROPDOWN -->
  <div class="
    absolute left-1/2 -translate-x-1/2 top-[140%]
    w-72

    opacity-0 invisible translate-y-4
    group-hover:opacity-100
    group-hover:visible
    group-hover:translate-y-0

    transition-all duration-300

    bg-black/80
    backdrop-blur-2xl

    border border-white/10
    rounded-3xl

    shadow-[0_20px_60px_rgba(0,0,0,0.6)]

    overflow-hidden
    z-[9999]
  ">

    <a href="/shop"
      class="
      flex items-center justify-between
      px-6 py-5
      hover:bg-white/5
      transition
      group/item
    ">

      <span class="font-semibold">
        All Products
      </span>

      <span class="text-red-500 opacity-0 group-hover/item:opacity-100 transition">
        →
      </span>

    </a>

    <a href="/shop?category=SUPERFLAME"
      class="
      flex items-center justify-between
      px-6 py-5
      hover:bg-white/5
      transition
      group/item
    ">

      <span class="font-semibold">
        SUPERFLAME
      </span>

      <span class="text-red-500 opacity-0 group-hover/item:opacity-100 transition">
        →
      </span>

    </a>

    <a href="/shop?category=NRG"
      class="
      flex items-center justify-between
      px-6 py-5
      hover:bg-white/5
      transition
      group/item
    ">

      <span class="font-semibold">
        NRG
      </span>

      <span class="text-red-500 opacity-0 group-hover/item:opacity-100 transition">
        →
      </span>

    </a>

  </div>

</div>

    <a href="/events" class="nav-link {{ request()->is('events') ? 'text-red-500' : '' }}">EVENTS</a>
    <a href="/rosters" class="nav-link {{ request()->is('rosters') ? 'text-red-500' : '' }}">ROSTERS</a>
    <a href="/audio" class="nav-link {{ request()->is('audio') ? 'text-red-500' : '' }}">AUDIO</a>

  </div>

  <!-- RIGHT: SEARCH + CART + AUTH -->
  <div class="ml-auto flex items-center space-x-4 text-sm">

    <!-- SEARCH -->
<button onclick="toggleSearch()" class="focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" 
    class="h-7 text-white hover:text-red-500 transition"
    fill="none" viewBox="0 0 24 24" stroke="currentColor">
    
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
      d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
  </svg>
</button>

    <!-- CART -->
<a href="javascript:void(0)" onclick="openCart()" class="relative">

  <svg xmlns="http://www.w3.org/2000/svg" 
    class="h-6 text-white hover:text-red-500 transition"
    fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
      d="M16.5 6V5a4.5 4.5 0 10-9 0v1M3.75 6h16.5l-1.2 13.2a2.25 2.25 0 01-2.24 2.05H7.19a2.25 2.25 0 01-2.24-2.05L3.75 6z" />
  </svg>

  @if(isset($cart) && count($cart) > 0)
  <span class="absolute -top-2 -right-2 bg-red-600 text-xs px-1.5 rounded-full">
    {{ count($cart) }}
  </span>
  @endif

</a>
    @guest
     <a href="/profile">
      <svg 
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 24 24" 
        stroke-width="1.8" 
        stroke="currentColor" 
        class="h-6 text-white hover:text-red-500 transition duration-200">
        
        <path stroke-linecap="round" stroke-linejoin="round" 
          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
      </svg>
    </a>
    @endguest

    @auth
    
    <a href="/profile">
      <svg 
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 24 24" 
        stroke-width="1.8" 
        stroke="currentColor" 
        class="h-6 text-white hover:text-red-500 transition duration-200">
        
        <path stroke-linecap="round" stroke-linejoin="round" 
          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
      </svg>
    </a>
    
    <form action="/logout" method="POST">
      @csrf
      <button class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
        Logout
      </button>
    </form>
    @endauth

  </div>

</nav>

<!-- MOBILE MENU -->
<div id="mobileMenu"
  class="fixed top-0 left-0 w-full h-screen bg-[#0a0a0a]
  z-[999] transform translate-x-full transition-transform duration-300 md:hidden">

  <!-- HEADER -->
  <div class="flex items-center justify-between px-6 py-5 border-b border-gray-800">

    <img src="{{ asset('assets/sflamered.png') }}"
      class="h-14">

    <button onclick="toggleMobileMenu()"
      class="text-white hover:text-red-500">

      <svg xmlns="http://www.w3.org/2000/svg"
        class="h-8 w-8"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

        <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1.8"
          d="M6 18L18 6M6 6l12 12"/>
      </svg>

    </button>

  </div>

  <!-- LINKS -->
  <div class="flex flex-col px-6 py-8 space-y-6 text-lg">

    <a href="/" class="nav-link">HOME</a>

    <a href="/sessions" class="nav-link">SESSIONS</a>

    <a href="/shop" class="nav-link">SHOP</a>

    <a href="/events" class="nav-link">EVENTS</a>

    <a href="/rosters" class="nav-link">ROSTERS</a>
    
    <a href="/audio" class="nav-link">AUDIO</a>

    <!-- MOBILE ACTIONS -->
    <div class="pt-6 border-t border-gray-800 flex items-center gap-5">

      <!-- SEARCH -->
      <button onclick="toggleSearch()">

        <svg xmlns="http://www.w3.org/2000/svg"
          class="h-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">

          <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.8"
            d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>

      </button>

      <!-- CART -->
      <button onclick="openCart()">

        <svg xmlns="http://www.w3.org/2000/svg"
          class="h-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">

          <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.8"
            d="M16.5 6V5a4.5 4.5 0 10-9 0v1M3.75 6h16.5l-1.2 13.2a2.25 2.25 0 01-2.24 2.05H7.19a2.25 2.25 0 01-2.24-2.05L3.75 6z"/>
        </svg>

      </button>

      <!-- PROFILE -->
      <a href="/profile">

        <svg xmlns="http://www.w3.org/2000/svg"
          class="h-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">

          <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.8"
            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
        </svg>

      </a>

    </div>

  </div>

</div>

   <div class="pt-24 md:pt-20">
    @yield('content')
</div>

  <!-- FOOTER -->
<footer class="border-t border-white/10 bg-black">

    <div class="max-w-[1600px] mx-auto px-6 md:px-10 py-16">

        <div class="grid md:grid-cols-4 gap-12">

            <!-- BRAND -->
            <div>

                <img src="{{ asset('assets/sflamered.png') }}"
                     class="h-16 mb-6">

                <p class="text-gray-500 leading-relaxed text-sm max-w-xs">
                    Underground collective focused on music, fashion,
                    culture and immersive experiences.
                </p>

            </div>

            <!-- NAVIGATION -->
            <div>

                <h3 class="text-white font-bold mb-5 tracking-[2px] text-sm">
                    NAVIGATION
                </h3>

                <div class="flex flex-col gap-3 text-sm text-gray-400">

                    <a href="/" class="hover:text-red-500 transition">
                        HOME
                    </a>

                    <a href="/sessions" class="hover:text-red-500 transition">
                        SESSIONS
                    </a>

                    <a href="/shop" class="hover:text-red-500 transition">
                        SHOP
                    </a>

                    <a href="/events" class="hover:text-red-500 transition">
                        EVENTS
                    </a>

                    <a href="/rosters" class="hover:text-red-500 transition">
                        ROSTERS
                    </a>

                    <a href="/audio" class="hover:text-red-500 transition">
                        AUDIO
                    </a>

                </div>

            </div>

            <!-- SOCIAL -->
            <div>

                <h3 class="text-white font-bold mb-5 tracking-[2px] text-sm">
                    SOCIAL
                </h3>

                <div class="flex flex-col gap-3 text-sm text-gray-400">

                    <a href="https://www.instagram.com/superflame__"
                       target="_blank"
                       class="hover:text-red-500 transition">

                        INSTAGRAM

                    </a>

                    <a href="https://soundcloud.com/superflame99"
                       target="_blank"
                       class="hover:text-red-500 transition">

                        SOUNDCLOUD

                    </a>

                    <a href="https://superflame.bandcamp.com"
                       target="_blank"
                       class="hover:text-red-500 transition">

                        BANDCAMP

                    </a>

                    <a href="https://wa.me/message/3ZLKMDCOKNZSL1"
                       target="_blank"
                       class="hover:text-red-500 transition">

                        CONTACT

                    </a>

                </div>

            </div>

            <!-- NEWSLETTER / INFO -->
            <div>

                <h3 class="text-white font-bold mb-5 tracking-[2px] text-sm">
                    SUPERFLAME
                </h3>

                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Stay connected for upcoming drops,
                    underground sessions and limited releases.
                </p>

                <button
                    onclick="window.open('https://www.instagram.com/superflame__', '_blank')"
                    class="border border-red-500 px-5 py-3 text-xs tracking-[3px]
                    uppercase hover:bg-red-500 transition rounded-full">

                    Follow Us

                </button>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="border-t border-white/10 mt-14 pt-6
        flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-gray-600 text-xs tracking-[2px] uppercase">
                © 2026 Superflame Collective
            </p>

            <p class="text-gray-600 text-xs tracking-[2px] uppercase">
                Designed by Flure Studio
            </p>

        </div>

    </div>

</footer>


</div>

@include('components.auth-modal')

<script>

function toggleMobileMenu() {

  const menu = document.getElementById('mobileMenu');

  menu.classList.toggle('translate-x-full');
}

</script>
</body>
<script>
function openAuthModal() {
  document.getElementById('authModal').classList.remove('hidden');
}

function closeAuthModal() {
  document.getElementById('authModal').classList.add('hidden');
}
</script>

<script>
function openCart() {
  document.getElementById('cartDrawer').classList.remove('translate-x-full');
  document.getElementById('cartOverlay').classList.remove('hidden');
}


function closeCart() {
  document.getElementById('cartDrawer').classList.add('translate-x-full');
  document.getElementById('cartOverlay').classList.add('hidden');
}

// klik overlay = tutup
document.getElementById('cartOverlay').addEventListener('click', closeCart);
</script>

@if(session('openCart'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    openCart();
  });
</script>
@endif
</html>