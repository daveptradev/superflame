<nav class="flex justify-between items-center px-8 py-4 border-b border-gray-800">

  <!-- LOGO -->
  <a href="/">
    <img src="{{ asset('assets/sflamered.png') }}" class="h-16">
  </a>

  <!-- RIGHT MENU -->
  <div class="flex items-center space-x-6 text-sm flex-nowrap">

    <a href="/" class="hover:text-red-500">HOME</a>
    <a href="#" class="hover:text-red-500">SESSIONS</a>
    <a href="/shop" class="hover:text-red-500">SHOP</a>
    <a href="/events" class="hover:text-red-500">EVENTS</a>
    <a href="/rosters" class="hover:text-red-500">ROSTERS</a>

    <!-- SEARCH -->
    <input 
      type="text" 
      placeholder="Search..." 
      class="bg-gray-900 border border-gray-700 text-sm px-3 py-1.5 rounded-lg focus:outline-none focus:border-red-500 w-40"
    >

    <!-- CART -->
   <a href="javascript:void(0)" onclick="openCart()">
    <svg 
      xmlns="http://www.w3.org/2000/svg" 
      fill="none" 
      viewBox="0 0 24 24" 
      stroke-width="1.8" 
      stroke="currentColor" 
      class="h-6 text-white hover:text-red-500 transition duration-200">
      
      <path stroke-linecap="round" stroke-linejoin="round" 
        d="M16.5 6V5a4.5 4.5 0 10-9 0v1M3.75 6h16.5l-1.2 13.2a2.25 2.25 0 01-2.24 2.05H7.19a2.25 2.25 0 01-2.24-2.05L3.75 6z" />
    </svg>
  </a>

    <!-- USER -->
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

    {{-- 
    @guest
    <button onclick="window.location.href='/signin'" class="hover:text-red-500">
      Sign In
    </button>

    <button onclick="window.location.href='/signup'" class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
      Sign Up
    </button>    
    @endguest
    --}}

    @auth
    <form action="/logout" method="POST">
      @csrf
      <button class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
        Logout
      </button>
    </form>
    @endauth

  </div>

</nav>

{{--profile page--}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">

        <!-- TITLE -->
        <h1 class="text-4xl font-extrabold text-white mb-8">
            My Account
        </h1>

        <!-- LOGIN / SIGNUP -->
        @guest
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                        Enjoy Special Discounts and Stay Connected
                    </h2>

                    <p class="text-gray-500 text-sm font-medium leading-relaxed max-w-3xl">
                        Get access to exclusive discounts while keeping track of your orders.
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="/signin"
                       class="px-8 py-3 rounded-full border border-gray-800 text-gray-900 font-semibold hover:bg-gray-100">
                        Login
                    </a>

                    <a href="/signup"
                       class="px-8 py-3 rounded-full bg-red-600 text-white font-semibold hover:bg-red-700">
                        Signup
                    </a>
                </div>

            </div>
        </div>
        @endguest

        <!-- ACCOUNT CONTENT -->
        @auth
        <div class="bg-white rounded-xl border border-gray-200 p-6">

            <!-- TABS -->
            <div class="grid grid-cols-2 border-b border-gray-200 mb-6">

                <button id="tab-orders"
                    onclick="showTab('orders')"
                    class="pb-3 font-bold border-b-2 border-gray-900 text-gray-900">
                    Orders
                </button>

                <button id="tab-wishlist"
                    onclick="showTab('wishlist')"
                    class="pb-3 font-bold text-gray-400 hover:text-gray-700 transition">
                    Wishlist
                </button>

            </div>

            <!-- ORDERS -->
            <div id="orders-content">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-16">

                    <h3 class="text-3xl font-extrabold text-gray-900">
                        My Orders (0)
                    </h3>

                    <select
                        class="border border-gray-300 rounded-xl px-5 py-3 font-semibold text-gray-700">
                        <option>All status</option>
                        <option>Pending</option>
                        <option>Paid</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                </div>

                <!-- EMPTY -->
                <div class="flex flex-col items-center justify-center py-24 text-center">

                    <div class="w-16 h-16 mb-5 text-gray-300">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7l9-4 9 4m-18 0l9 4m-9-4v10l9 4m9-14v10l-9 4m0-10v10" />
                        </svg>
                    </div>

                    <h4 class="text-2xl font-bold text-gray-900 mb-2">
                        No Orders Found
                    </h4>

                    <p class="text-gray-500 font-medium">
                        Place an order to see it listed here.
                    </p>

                </div>

            </div>

            <!-- WISHLIST -->
            <div id="wishlist-content" class="hidden">

                <h3 class="text-3xl font-extrabold text-gray-900 mb-10">
                    My Wishlist (0)
                </h3>

                <div class="flex flex-col items-center justify-center py-24 text-center">

                    <div class="w-16 h-16 mb-5 text-gray-300">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.74 0-3.26.81-4 2.04C11.26 4.56 9.74 3.75 8 3.75c-2.761 0-5 2.015-5 4.5 0 7.5 9 11.25 9 11.25s9-3.75 9-11.25z"/>
                        </svg>
                    </div>

                    <h4 class="text-2xl font-bold text-gray-900 mb-2">
                        No Wishlist Yet
                    </h4>

                    <p class="text-gray-500">
                        Save your favorite items here.
                    </p>

                </div>

            </div>

        </div>
        @endauth

    </div>
</div>

<!-- SCRIPT TAB -->
<script>
function showTab(tab) {
    const orders = document.getElementById('orders-content');
    const wishlist = document.getElementById('wishlist-content');

    const tabOrders = document.getElementById('tab-orders');
    const tabWishlist = document.getElementById('tab-wishlist');

    if (tab === 'orders') {
        orders.classList.remove('hidden');
        wishlist.classList.add('hidden');

        tabOrders.classList.add('border-gray-900', 'text-gray-900');
        tabOrders.classList.remove('text-gray-400');

        tabWishlist.classList.remove('border-gray-900', 'text-gray-900');
        tabWishlist.classList.add('text-gray-400');

    } else {
        wishlist.classList.remove('hidden');
        orders.classList.add('hidden');

        tabWishlist.classList.add('border-gray-900', 'text-gray-900');
        tabWishlist.classList.remove('text-gray-400');

        tabOrders.classList.remove('border-gray-900', 'text-gray-900');
        tabOrders.classList.add('text-gray-400');
    }
}
</script>

@endsection

<!-- CHECKOUT DRAFT -->

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/css/intlTelInput.css">

@php
$cart = session('direct_checkout') ?? session('cart', []);
@endphp

@php
$weight = 0;
foreach($cart as $item){
    $weight += $item['qty'] * 500; // misal 1 item = 500gr
}
@endphp

<!-- MIDTRANS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<!-- MIDTRANS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<div class="max-w-7xl mx-auto px-6 py-16 grid lg:grid-cols-2 gap-16 text-white">

  <!-- LEFT SIDE -->
  <div>

    <h1 class="text-3xl font-bold mb-10">Checkout</h1>

    <form id="checkout-form" class="space-y-10">

      @csrf

      <!-- CONTACT -->
      <div>
        <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
          Contact
        </h2>

        <input type="email" name="email" required
          placeholder="Email"
          class="w-full bg-transparent border-b border-gray-700 py-3 
          focus:outline-none focus:border-red-500 transition">
      </div>

      

      
<!-- SHIPPING -->
<div>

    <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
        Shipping Address
    </h2>

    <!-- NAME -->
    <div class="grid grid-cols-2 gap-4">

        <input
            type="text"
            name="first_name"
            placeholder="First name"
            class="bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

        <input
            type="text"
            name="last_name"
            placeholder="Last name"
            class="bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

    </div>

    <!-- ADDRESS -->
    <input
        type="text"
        name="address"
        id="address"
        placeholder="Address"
        class="w-full mt-4 bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

    <!-- DESTINATION SEARCH -->
    <div class="relative mt-4">

        <input
            type="text"
            id="destination-search"
            placeholder="Ketik Kota / Kecamatan"
            autocomplete="off"
            class="w-full bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

        <!-- RESULT -->
        <div
            id="search-results"
            class="absolute left-0 top-full mt-2 z-50 bg-[#111]
            w-full rounded-xl border border-gray-800
            overflow-hidden hidden max-h-64 overflow-y-auto shadow-2xl">
        </div>

    </div>

    <!-- HIDDEN DESTINATION -->
    <input
        type="hidden"
        name="destination_id"
        id="destination-id">

    <!-- PROVINCE + POSTAL -->
    <div class="grid grid-cols-2 gap-4 mt-4">

        <select
            name="province"
            id="province"
            class="w-full bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500 text-white">

            <option value="" disabled selected>
                Select Province
            </option>

            <option value="DKI Jakarta">DKI Jakarta</option>
            <option value="Jawa Barat">Jawa Barat</option>
            <option value="Jawa Tengah">Jawa Tengah</option>
            <option value="Jawa Timur">Jawa Timur</option>
            <option value="DI Yogyakarta">DI Yogyakarta</option>
            <option value="Banten">Banten</option>
            <option value="Bali">Bali</option>
            <option value="Sumatera Utara">Sumatera Utara</option>
            <option value="Sumatera Selatan">Sumatera Selatan</option>
            <option value="Kalimantan Timur">Kalimantan Timur</option>
            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
            <option value="NTB">NTB</option>
            <option value="NTT">NTT</option>
            <option value="Papua">Papua</option>

        </select>

        <input
            type="text"
            name="postal_code"
            id="postal_code"
            placeholder="Postal Code"
            class="w-full bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

    </div>

    <!-- PHONE -->
    <div class="mt-4">

        <input
            type="tel"
            id="phone"
            class="w-full bg-transparent border-b border-gray-700 py-3 pl-16 focus:outline-none focus:border-red-500">

        <input
            type="hidden"
            name="phone"
            id="full-phone">

    </div>

    <!-- SHIPPING OPTIONS -->
    <div
        id="shipping-options"
        class="mt-6 space-y-3">
    </div>

    <!-- SHIPPING COST -->
    <input
        type="hidden"
        name="shipping_cost"
        id="shipping-cost">

</div>

      <!-- BUTTON -->
      <button type="submit" id="pay-button"
        class="w-full bg-red-600 py-4 text-lg font-semibold rounded-lg
        hover:bg-red-700 hover:scale-[1.02] active:scale-[0.98] transition">
        Pay Now
      </button>



    </form>

  </div>


  <!-- RIGHT SIDE -->
  <div class="bg-[#111] p-6 rounded-xl border border-gray-800 h-fit sticky top-24">

    <h2 class="text-lg font-semibold mb-6">Order Summary</h2>

    @php $total = 0; @endphp

    @foreach($cart as $item)
    <div class="flex justify-between items-start mb-5 text-sm">

      <div>
        <p class="font-medium">{{ $item['name'] }}</p>
        <p class="text-gray-400 text-xs mt-1">
          Size {{ $item['size'] }} · Qty {{ $item['qty'] }}
        </p>
      </div>

      <p class="text-red-500">
        IDR {{ number_format($item['price'] * $item['qty']) }}
      </p>

    </div>

    @php $total += $item['price'] * $item['qty']; @endphp
    @endforeach

    <!-- SUMMARY -->
    <div class="border-t border-gray-700 pt-4 mt-6 space-y-2 text-sm">

      <div class="flex justify-between">
        <span>Subtotal</span>
        <span>IDR {{ number_format($total) }}</span>
      </div>

      <div class="flex justify-between text-gray-400">
        <span>Shipping</span>
        <span id="shippingText">IDR 0</span>
      </div>

    </div>

    <div class="border-t border-gray-700 pt-4 mt-6 flex justify-between font-bold text-lg">
      <span>Total</span>
      <span class="text-red-500" id="totalText">
  IDR {{ number_format($total) }}
</span>
    </div>

  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  

  // Variabel Global dari PHP
  const subtotal = {{ $total }};
  const weight = {{ $weight > 0 ? $weight : 1000 }}; // Berat dalam gram

  // Elemen DOM
  const form = document.getElementById('checkout-form');
  const destSearch = document.getElementById('destination-search');
  const destIdInput = document.getElementById('destination-id'); // Pastikan ID ini ada di HTML
  const searchResults = document.getElementById('search-results');
  const shippingOptions = document.getElementById('shipping-options');
  const shippingText = document.getElementById('shippingText');
  const totalText = document.getElementById('totalText');

  // ==========================================
  // 1. PENCARIAN LOKASI (AUTOCOMPLETE)
  // ==========================================
  if (destSearch) {
    destSearch.addEventListener('input', function() {
      let query = this.value;
      if (query.length < 3) {
        searchResults.classList.add('hidden');
        return;
      }

      // Memanggil endpoint locations sesuai dokumentasi
      fetch(`/api/binderbyte/locations?search=${query}`)
        .then(res => res.json())
        .then(res => {
          let html = '';
          // Binderbyte v1 menggunakan res.code dan res.data
          if (res.code == "200" && res.data.length > 0) {
            res.data.forEach(item => {
              html += `
                <div class="p-3 hover:bg-red-600 cursor-pointer border-b border-gray-800 text-xs text-white" 
                     onclick="selectDestination('${item.id}', '${item.label}')">
                    ${item.label}
                </div>`;
            });
            searchResults.innerHTML = html;
            searchResults.classList.remove('hidden');
          }
        })
        .catch(err => console.error("Error search:", err));
    });
  }

  // Fungsi saat lokasi diklik
  window.selectDestination = function(id, label) {
    destSearch.value = label;
    destIdInput.value = id;
    searchResults.classList.add('hidden');
    
    // Langsung hitung ongkir
    fetchShippingCosts(id);
  };

  // ==========================================
  // 2. HITUNG ONGKIR (FETCH COSTS)
  // ==========================================
  function fetchShippingCosts(destinationId) {
    shippingOptions.innerHTML = '<p class="text-xs text-gray-400 animate-pulse py-4">Calculating shipping rates...</p>';

    fetch('/api/binderbyte/get-costs', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      },
      body: JSON.stringify({
        destination: destinationId,
        weight: weight,
        courier: 'jne,jnt,sicepat,pos' // Sesuai dokumentasi
      })
    })
    .then(res => res.json())
    .then(res => {
      if (res.code != "200") {
        shippingOptions.innerHTML = `<p class="text-red-500 text-xs">${res.message}</p>`;
        return;
      }

      let html = '<h3 class="text-xs uppercase tracking-widest text-gray-400 mb-3">Shipping Method</h3>';
      
      // Double Loop: Results (Kurir) -> Costs (Layanan)
      res.data.results.forEach(courier => {
        courier.costs.forEach(service => {
          const price = parseInt(service.price);
          html += `
            <label class="flex justify-between items-center p-4 border border-gray-800 rounded-xl cursor-pointer hover:border-red-600 transition bg-[#111] mb-2">
              <div class="flex items-center gap-3">
                <input type="radio" name="shipping_radio" value="${price}" 
                       class="w-4 h-4 accent-red-600" 
                       onchange="updateSummary(${price}, '${courier.name} - ${service.service}')">
                <div>
                  <p class="text-sm font-bold uppercase text-white">${courier.name} (${service.service})</p>
                  <p class="text-[10px] text-gray-500">Estimasi: ${service.estimated}</p>
                </div>
              </div>
              <span class="text-sm font-bold text-red-500">IDR ${new Intl.NumberFormat().format(price)}</span>
            </label>`;
        });
      });
      shippingOptions.innerHTML = html;
    })
    .catch(err => {
      console.error("Error shipping:", err);
      shippingOptions.innerHTML = '<p class="text-red-500 text-xs">Failed to load shipping rates.</p>';
    });
  }

  // Update Ringkasan Total
  window.updateSummary = function(price, label) {
    document.getElementById('shipping-cost').value = price;
    shippingText.innerText = "IDR " + new Intl.NumberFormat().format(price);
    
    const finalTotal = subtotal + price;
    totalText.innerText = "IDR " + new Intl.NumberFormat().format(finalTotal);
  };

  // ==========================================
  // 3. PAYMENT SUBMIT (MIDTRANS)
  // ==========================================
  if (form) {
    form.addEventListener('submit', function(e) {
  e.preventDefault();

  const shippingVal = document.getElementById('shipping-cost').value;

  // Cek apakah ongkir sudah dipilih
  if (!shippingVal || shippingVal == "" || shippingVal == "0") {
    alert("Harap pilih kurir pengiriman terlebih dahulu!");
    return;
  }

  const btn = form.querySelector('button');
  btn.innerText = "Processing...";
  btn.disabled = true;

  const formData = new FormData(form);

  fetch('/snap/token', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    },
    body: formData
})
.then(async res => {

    const data = await res.json();

    // 🔥 HANDLE ERROR RESPONSE
    if (!res.ok) {

        alert(data.message || 'Server Error');

        reset();

        return;
    }

    // 🔥 SNAP TOKEN ADA
    if (data.snapToken) {

        snap.pay(data.snapToken, {

            onSuccess: function(result) {

                console.log(result);

                // 🔥 kasih delay supaya callback selesai
                setTimeout(() => {

                    window.location.href = "/payment/success";

                }, 3000);
            },

            onPending: function(result) {

                console.log(result);

                alert("Waiting for payment...");

                reset();
            },

            onError: function(result) {

                console.log(result);

                alert("Payment failed!");

                reset();
            },

            onClose: function() {

                reset();
            }
        });

    } else {

        alert(data.message || "Snap token gagal dibuat");

        reset();
    }
})
.catch(err => {

    console.error(err);

    alert("Koneksi bermasalah!");

    reset();
});

  function reset() {
    btn.innerText = "Pay Now";
    btn.disabled = false;
  }
});
  }

  // ==========================================
  // 4. PHONE INPUT
  // ==========================================
  const phoneInput = document.querySelector("#phone");
  if (phoneInput && window.intlTelInput) {
    const iti = window.intlTelInput(phoneInput, {
      initialCountry: "id",
      separateDialCode: true,
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/js/utils.js"
    });
    form?.addEventListener('submit', () => {
      document.getElementById('full-phone').value = iti.getNumber();
    });
  }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/js/intlTelInput.min.js"></script>



@endsection
