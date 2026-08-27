@extends('layouts.app')

@section('title', 'Checkout - Superflame')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/css/intlTelInput.css">

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/js/intlTelInput.min.js"></script>

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
<script src="https://app.midtrans.com/snap/snap.js"
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

      

      

      <!-- SHIPPING -->  <!-- SHIPPING -->
<div>
  <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
    Shipping Address
  </h2>

  <div class="grid grid-cols-2 gap-4">
    <input type="text" name="first_name" placeholder="First name"
      class="bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

    <input type="text" name="last_name" placeholder="Last name"
      class="bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">
  </div>

  <input type="text" name="address" id="address" placeholder="Address"
    class="w-full mt-4 bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">

    <div class="grid grid-cols-2 gap-4">
    <select name="province" id="province"
  class="w-full mt-4 bg-transparent border-b border-gray-700 py-3 
  focus:outline-none focus:border-red-500 text-white">

  <option value="" disabled selected>Select Province</option>

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
  <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
  <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
  <option value="Papua">Papua</option>

</select>

<input type="text" name="postal_code" id="postal_code"
  placeholder="Postal Code"
  class="w-full mt-4 bg-transparent border-b border-gray-700 py-3 focus:outline-none focus:border-red-500">
  
    
  <input type="hidden"
  id="destination_latitude">

<input type="hidden"
  id="destination_longitude">
  </div>

        <input type="tel" id="phone"
  class="w-full bg-transparent border-b border-gray-700 mt-4 py-3 pl-16 focus:outline-none focus:border-red-500">
    <input type="hidden" name="phone" id="full-phone">
   


  <!-- 🔥 SHIPPING OPTIONS -->
  <div id="shipping-options" class="mt-6 space-y-3"></div>

  <input type="hidden" name="shipping_cost" id="shipping-cost">

  <input type="hidden" name="courier" id="courier">

<input type="hidden"
  name="courier_service"
  id="courier_service">
 
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

<!-- TOAST NOTIFICATION -->
<div
    id="toast"
    class="fixed top-6 left-1/2 -translate-x-1/2
z-[9999]
bg-red-600 text-white
px-5 py-4 rounded-2xl
shadow-2xl
-translate-y-[200%]
transition duration-300">

    <span id="toast-message"></span>

</div>



<script>
document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // TOAST NOTIFICATION
    // ==========================================

    function showToast(message) {

        const toast =
            document.getElementById('toast');

        const toastMessage =
            document.getElementById('toast-message');

        toastMessage.innerText = message;

        toast.classList.remove('-translate-y-[200%]');

        setTimeout(() => {

            toast.classList.add('-translate-y-[200%]');

        }, 3000);
    }

    // ==========================================
    // GLOBAL
    // ==========================================

    const subtotal = {{ $total }};
    const weight = {{ $weight > 0 ? $weight : 1000 }};

    const form =
        document.getElementById('checkout-form');

    const shippingOptions =
        document.getElementById('shipping-options');

    const shippingText =
        document.getElementById('shippingText');

    const totalText =
        document.getElementById('totalText');

    // ==========================================
    // PHONE INPUT
    // ==========================================

    const phoneField =
        document.querySelector("#phone");

    let iti = null;

    if (phoneField && window.intlTelInput) {

        iti = window.intlTelInput(phoneField, {

            initialCountry: "id",

            separateDialCode: true,

            utilsScript:
            "https://cdn.jsdelivr.net/npm/intl-tel-input@18/build/js/utils.js"
        });
    }

    // ==========================================
    // AUTO FETCH SHIPPING
    // ==========================================

    function tryFetchShipping() {

        const address =
            document.getElementById('address').value;

        const province =
            document.getElementById('province').value;

        const postal =
            document.getElementById('postal_code').value;

        if (address && province && postal) {

            fetchShippingCosts();
        }
    }

    document.getElementById('address')
        .addEventListener('blur', tryFetchShipping);

    document.getElementById('province')
        .addEventListener('change', tryFetchShipping);

    document.getElementById('postal_code')
        .addEventListener('blur', tryFetchShipping);

    // ==========================================
    // FETCH SHIPPING
    // ==========================================

    async function fetchShippingCosts() {

        shippingOptions.innerHTML = `
            <p class="text-xs text-gray-400 animate-pulse py-4">
                Calculating shipping rates...
            </p>
        `;

        try {

            const response =
                await fetch('/api/shipping-rate', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'input[name="_token"]'
                            ).value
                    },

                    body: JSON.stringify({

                        destination_postal_code:
                            document.getElementById(
                                'postal_code'
                            ).value,

                        weight: weight
                    })
                });

            const res =
                await response.json();

            console.log(res);

            if (!res.pricing || res.pricing.length === 0) {

                shippingOptions.innerHTML = `
                    <p class="text-red-500 text-xs">
                        Shipping not available
                    </p>
                `;

                return;
            }

            let html = `
                <h3 class="text-xs uppercase tracking-widest text-gray-400 mb-3">
                    Shipping Method
                </h3>
            `;

            res.pricing.forEach(service => {

                // FILTER COURIER
                if (

                    !(

                        (
                            service.courier_code === 'jne' &&
                            service.courier_service_code === 'reg'
                        )

                        ||

                        (
                            service.courier_code === 'jnt' &&
                            service.courier_service_code === 'ez'
                        )

                    )

                ) {

                    return;
                }

                const price =
                    parseInt(service.price);

                html += `

                <label class="flex justify-between items-center
                    p-4 border border-gray-800 rounded-xl
                    cursor-pointer hover:border-red-600
                    transition bg-[#111] mb-2">

                    <div class="flex items-center gap-3">

                        <input type="radio"
                            name="shipping_radio"
                            value="${price}"
                            class="w-4 h-4 accent-red-600"
                            onchange="updateSummary(
                                ${price},
                                '${service.courier_code}',
                                '${service.courier_service_code}'
                            )">

                        <img
                            src="${
                                service.courier_code === 'jne'
                                ? '/assets/jne.png'
                                : '/assets/jnt.png'
                            }"
                            class="w-10 h-10 object-cover bg-white rounded-lg p-1">

                        <div>

                            <p class="text-sm font-bold uppercase text-white">

                                ${service.courier_name}
                                (${service.courier_service_name})

                            </p>

                            <p class="text-[10px] text-gray-500">

                                Estimasi:
                                ${service.duration}

                            </p>

                        </div>

                    </div>

                    <span class="text-sm font-bold text-red-500">

                        IDR ${new Intl.NumberFormat().format(price)}

                    </span>

                </label>
                `;
            });

            shippingOptions.innerHTML = html;

        } catch (err) {

            console.error(err);

            shippingOptions.innerHTML = `
                <p class="text-red-500 text-xs">
                    Failed to load shipping rates.
                </p>
            `;
        }
    }

    // ==========================================
    // UPDATE TOTAL
    // ==========================================

    window.updateSummary = function(
        price,
        courier,
        service
    ) {

        document.getElementById(
            'shipping-cost'
        ).value = price;

        document.getElementById(
            'courier'
        ).value = courier;

        document.getElementById(
            'courier_service'
        ).value = service;

        shippingText.innerText =
            "IDR " +
            new Intl.NumberFormat().format(price);

        const finalTotal =
            subtotal + price;

        totalText.innerText =
            "IDR " +
            new Intl.NumberFormat().format(finalTotal);
    };

    // ==========================================
    // MIDTRANS PAYMENT
    // ==========================================

    const payButton =
        document.getElementById('pay-button');

    if (payButton) {

        payButton.type = 'button';

        payButton.addEventListener('click', async function () {

            const email =
                document.querySelector(
                    'input[name="email"]'
                ).value;

            const firstName =
                document.querySelector(
                    'input[name="first_name"]'
                ).value;

            const address =
                document.getElementById('address').value;

            const province =
                document.getElementById('province').value;

            const postalCode =
                document.getElementById('postal_code').value;

            const phone =
                document.getElementById('phone').value;

            // VALIDATION
            if (!email.trim()) {
                showToast("Please enter your email address.");
                return;
            }

            if (!firstName.trim()) {
                showToast("Please enter your first name.");
                return;
            }

            if (!address.trim()) {
                showToast("Please enter your address.");
                return;
            }

            if (!province.trim()) {
                showToast("Please select your province.");
                return;
            }

            if (!postalCode.trim()) {
                showToast("Please enter your postal code.");
                return;
            }

            if (!phone.trim()) {
                showToast("Please enter your phone number.");
                return;
            }

            const shippingVal =
                document.getElementById(
                    'shipping-cost'
                ).value;

            if (!shippingVal || shippingVal == "0") {

                showToast(
                    "Please select shipping courier."
                );

                return;
            }

            // FULL PHONE
            if (iti) {

                document.getElementById(
                    'full-phone'
                ).value = iti.getNumber();
            }

            payButton.innerText =
                "Processing...";

            payButton.disabled = true;

            const formData =
                new FormData(form);

            try {

                const response =
                    await fetch('/snap/token', {

                        method: 'POST',

                        headers: {

                            'Accept': 'application/json',

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'input[name="_token"]'
                                ).value
                        },

                        body: formData
                    });

                const data =
                    await response.json();

                console.log(data);

                if (!response.ok) {

                    alert(
                        data.message ||
                        'Server Error'
                    );

                    resetButton();

                    return;
                }

                if (!data.snapToken) {

                    alert(
                        'Snap token gagal dibuat'
                    );

                    resetButton();

                    return;
                }

                snap.pay(data.snapToken, {

                    onSuccess: function(result) {

                        console.log(result);

                        setTimeout(() => {

                            window.location.href =
                                "/payment/success";

                        }, 3000);
                    },

                    onPending: function(result) {

                        console.log(result);

                        alert(
                            "Waiting for payment..."
                        );

                        resetButton();
                    },

                    onError: function(result) {

                        console.log(result);

                        alert(
                            "Payment failed!"
                        );

                        resetButton();
                    },

                    onClose: function() {

                        resetButton();
                    }
                });

            } catch (err) {

                console.error(err);

                alert("Koneksi bermasalah!");

                resetButton();
            }

            function resetButton() {

                payButton.innerText =
                    "Pay Now";

                payButton.disabled = false;
            }
        });
    }
});
</script>






@endsection