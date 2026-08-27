@extends('layouts.app')

@section('title', 'Profile - Superflame')

@section('content')
<div class="min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-extrabold text-white mb-8">
            My Account
        </h1>

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
                    <button onclick="openAuth('login')"
                        class="px-8 py-3 rounded-full border border-gray-800 text-gray-900 font-semibold hover:bg-gray-100">
                        Login
                    </button>
                    <button onclick="openAuth('register')"
                        class="px-8 py-3 rounded-full bg-red-600 text-white font-semibold hover:bg-red-700">
                        Signup
                    </button>
                </div>
            </div>
        </div>
        @endguest

        @auth
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                        HI, {{ auth()->user()->name }}
                    </h2>
                    <p class="text-gray-500 text-sm font-medium leading-relaxed max-w-3xl">
                        Get access to exclusive discounts while keeping track of your orders.
                    </p>
                </div>
                <button onclick="openSettings()"
                    class="px-8 py-3 rounded-full border border-gray-800 text-gray-900 font-semibold hover:bg-gray-100">
                    Settings
                </button>
            </div>
        </div>
        @endauth

        <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <!-- ACCOUNT TAB -->
            <!-- ACCOUNT TAB -->
                <div class="mb-8">
                
                    <div class="flex">
                
                        <button id="tab-orders"
                            onclick="showTab('orders')"
                            class="account-switch active-switch">
                            Orders
                        </button>
                
                        <button id="tab-wishlist"
                            onclick="showTab('wishlist')"
                            class="account-switch">
                            Wishlist
                        </button>
                
                    </div>
                
                </div>

            <div id="orders-content">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 md:mb-16">

        <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
            My Orders ({{ $orders->count() }})
        </h3>

        <select
            class="w-full sm:w-auto border border-gray-300 rounded-xl px-4 md:px-5 py-3 font-semibold text-sm md:text-base text-gray-700">

            <option>All status</option>
            <option>Pending</option>
            <option>Paid</option>
            <option>Completed</option>
            <option>Cancelled</option>

        </select>

    </div>

    @if($orders->count() > 0)

    <div class="space-y-6">

        @foreach($orders as $order)

        <div class="border border-gray-200 rounded-3xl p-5 md:p-7">

            <!-- TOP -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div>

                    <p class="text-xs uppercase tracking-[3px] text-gray-400 mb-2">
                        Order ID
                    </p>

                    <h4 class="font-bold text-gray-900">
                        {{ $order->midtrans_order_id }}
                    </h4>
                    
                    @if($order->tracking_number)

                    <div class="mt-2">
                    
                        <span class="inline-flex items-center
                        px-3 py-1 rounded-full
                        bg-green-100 text-green-700
                        text-xs font-bold">
                    
                            📦 Tracking:
                            {{ $order->tracking_number }}
                    
                        </span>
                    
                    </div>
                    
                    @endif

                </div>

                <!-- STATUS -->
                <div>

                    <span class="
                        px-4 py-2 rounded-full text-xs font-bold uppercase

                        {{ $order->status == 'pending'
                            ? 'bg-yellow-100 text-yellow-700'
                            : '' }}

                        {{ $order->status == 'paid'
                            ? 'bg-blue-100 text-blue-700'
                            : '' }}

                        {{ $order->status == 'completed'
                            ? 'bg-green-100 text-green-700'
                            : '' }}

                        {{ $order->status == 'cancelled'
                            ? 'bg-red-100 text-red-700'
                            : '' }}
                    ">

                        {{ $order->status }}

                    </span>

                </div>

            </div>

            <!-- ITEMS -->
            <div class="space-y-4">

                @foreach($order->items as $item)

                <div class="flex items-center gap-4">

                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        class="w-20 h-20 rounded-2xl object-cover">

                    <div class="flex-1">

                        <h5 class="font-bold text-gray-900">
                            {{ $item->product_name }}
                        </h5>

                        <p class="text-sm text-gray-500">
                            Size: {{ $item->size }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Qty: {{ $item->qty }}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold text-red-500">
                            IDR {{ number_format($item->price * $item->qty) }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

            <!-- FOOTER -->
            <div class="border-t border-gray-200 mt-6 pt-6">

                <div class="grid md:grid-cols-3 gap-6">
            
                    <!-- TOTAL -->
                    <div>
            
                        <p class="text-sm text-gray-400">
                            Total
                        </p>
            
                        <h4 class="text-xl font-extrabold text-gray-900">
                            IDR {{ number_format($order->total) }}
                        </h4>
            
                    </div>
            
                    <!-- PAYMENT -->
                    <div>
            
                        <p class="text-sm text-gray-400">
                            Payment
                        </p>
            
                        <p class="font-semibold text-gray-900">
                            {{ ucfirst($order->payment_status) }}
                        </p>
            
                    </div>
            
                    <!-- TRACKING -->
                    <div>
            
                        <p class="text-sm text-gray-400">
                            Tracking Number
                        </p>
            
                        @if($order->tracking_number)
            
                            <p class="font-bold text-blue-600 break-all">
                                {{ $order->tracking_number }}
                            </p>
            
                            <p class="text-xs text-gray-500 mt-1">
                                {{ strtoupper($order->courier) }}
                                {{ strtoupper($order->courier_service) }}
                            </p>
            
                        @else
            
                            <p class="text-gray-400">
                                Waiting for tracking number
                            </p>
            
                        @endif
            
                    </div>
            
                </div>
            
            </div>

        </div>

        @endforeach

    </div>

    @else

    <!-- EMPTY -->
    <div class="flex flex-col items-center justify-center py-16 md:py-24 text-center">

        <div class="w-14 h-14 md:w-16 md:h-16 mb-5 text-gray-300">

            <svg fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                class="w-full h-full">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 7l9-4 9 4m-18 0l9 4m-9-4v10l9 4m9-14v10l-9 4m0-10v10"/>

            </svg>

        </div>

        <h4 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">
            No Orders Found
        </h4>

        <p class="text-sm md:text-base text-gray-500 font-medium max-w-xs">
            Place an order to see it listed here.
        </p>

    </div>

    @endif

</div>

            <div id="wishlist-content" class="hidden">

    <div class="flex items-center justify-between mb-8">

        <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900">
            My Wishlist ({{ $wishlists->count() }})
        </h3>

    </div>

    @if($wishlists->count() > 0)

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">

        @foreach($wishlists as $wishlist)

        <div class="group">

            <!-- IMAGE -->
            <a href="/product/{{ $wishlist->product->id }}"
               class="block overflow-hidden rounded-2xl bg-gray-100">

                <img
                    src="{{ asset('storage/' . $wishlist->product->images->first()->image) }}"
                    class="w-full aspect-[3/4] object-cover group-hover:scale-105 transition duration-500">

            </a>

            <!-- INFO -->
            <div class="pt-4">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <p class="text-xs tracking-[3px] uppercase text-gray-400 mb-1">
                            {{ $wishlist->product->category }}
                        </p>

                        <h4 class="font-bold text-gray-900 leading-tight">
                            {{ $wishlist->product->name }}
                        </h4>

                    </div>

                    <!-- REMOVE -->
                    <form action="/wishlist/toggle/{{ $wishlist->product->id }}" method="POST">
                        @csrf

                        <button
                            class="text-red-500 hover:scale-110 transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 fill-current"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.74 0-3.26.81-4 2.04C11.26 4.56 9.74 3.75 8 3.75c-2.761 0-5 2.015-5 4.5 0 7.5 9 11.25 9 11.25s9-3.75 9-11.25z"/>
                            </svg>

                        </button>
                    </form>

                </div>

                <p class="text-red-500 font-bold mt-3">
                    IDR {{ number_format($wishlist->product->price) }}
                </p>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <!-- EMPTY STATE -->
    <div class="flex flex-col items-center justify-center py-20 text-center">

        <div class="w-16 h-16 mb-5 text-gray-300">

            <svg fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                class="w-full h-full">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.239-4.5-5-4.5-1.74 0-3.26.81-4 2.04C11.26 4.56 9.74 3.75 8 3.75c-2.761 0-5 2.015-5 4.5 0 7.5 9 11.25 9 11.25s9-3.75 9-11.25z"/>
            </svg>

        </div>

        <h4 class="text-2xl font-bold text-gray-900 mb-2">
            No Wishlist Yet
        </h4>

        <p class="text-gray-500 mb-6">
            Save your favorite items here.
        </p>

        <a href="/shop"
            class="bg-black text-white px-6 py-3 rounded-full hover:bg-red-600 transition">

            Explore Shop

        </a>

    </div>

    @endif

</div>
        </div>
    </div>
</div>

@auth
<div id="settingsModal" class="fixed inset-0 bg-black/70 backdrop-blur-xl opacity-0 pointer-events-none transition duration-300 z-[999]">
<div class="flex items-center justify-center
min-h-screen
p-3 md:p-4">
<div id="settingsBox"
class="w-full
max-w-[95vw] md:max-w-6xl

h-auto
max-h-[85vh]

overflow-hidden

bg-[#0f0f0f]/95
border border-white/10

rounded-[24px] md:rounded-[32px]

opacity-0 scale-95
transition duration-300
shadow-2xl">
            <div class="grid grid-cols-[100px_1fr] md:grid-cols-[260px_1fr]">
                <div class="border-r border-white/10
p-4 md:p-8">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-2xl font-extrabold text-white">
                            Settings
                        </h2>
                        <button onclick="closeSettings()" class="text-gray-500 hover:text-red-500 text-3xl">
                            &times;
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button onclick="switchSettingsTab('profile')" class="settings-tab active-settings-tab" id="settings-profile-btn">
                            My Profile
                        </button>
                        <button onclick="switchSettingsTab('security')" class="settings-tab" id="settings-security-btn">
                            Security
                        </button>
                        <button onclick="switchSettingsTab('orders')" class="settings-tab" id="settings-orders-btn">
                            Order History
                        </button>
                        <button onclick="switchSettingsTab('wishlist')" class="settings-tab" id="settings-wishlist-btn">
                            Wishlist
                        </button>
                        <button onclick="openDeleteModal()" class="settings-tab text-red-500 hover:bg-red-500/10">
                            Delete Account
                        </button>
                        <button onclick="openLogoutModal()" class="settings-tab">
                            Logout
                        </button>
                    </div>
                </div>

<div class="p-5 md:p-10
text-white
overflow-y-auto
max-h-[85vh]">
                    <div id="settings-profile">
                        <h2 class="text-2xl md:text-3xl font-bold mb-8">
                            My Profile
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">
                                    Name
                                </label>
                                <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">
                                    Email
                                </label>
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white">
                            </div>
                        </div>
                    </div>
                    <!-- SECURITY -->
                    <div id="settings-security" class="hidden">
                    
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-8">
                            Security
                        </h2>
                    
                        <form class="space-y-6">
                    
                            <input type="password"
                                placeholder="Current Password"
                                class="w-full bg-white/5 border border-white/10
                                rounded-2xl px-5 py-4 text-white">
                    
                            <input type="password"
                                placeholder="New Password"
                                class="w-full bg-white/5 border border-white/10
                                rounded-2xl px-5 py-4 text-white">
                    
                            <input type="password"
                                placeholder="Confirm Password"
                                class="w-full bg-white/5 border border-white/10
                                rounded-2xl px-5 py-4 text-white">
                    
                            <button
                                class="bg-red-600 hover:bg-red-700
                                px-8 py-4 rounded-2xl font-semibold transition text-white">
                    
                                Update Password
                    
                            </button>
                    
                        </form>
                    
                    </div>
                    
                    <!-- ORDERS -->
                    <div id="settings-orders" class="hidden">
                    
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-8">
                            Order History
                        </h2>
                    
                        <div class="border border-white/10 rounded-3xl p-10 text-center">
                    
                            <p class="text-gray-500">
                                No orders yet.
                            </p>
                    
                        </div>
                    
                    </div>
                    
                    <!-- WISHLIST -->
                    <div id="settings-wishlist" class="hidden">
                    
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-8">
                            Wishlist
                        </h2>
                    
                        <div class="border border-white/10 rounded-3xl p-10 text-center">
                    
                            <p class="text-gray-500">
                                No wishlist yet.
                            </p>
                    
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black/70 backdrop-blur-md hidden items-center justify-center z-[1000] p-4">
    <div class="bg-[#111] border border-white/10 rounded-3xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-white mb-4">
            Delete Account?
        </h2>
        <p class="text-gray-400 mb-8">
            This action cannot be undone.
        </p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 border border-white/10 py-3 rounded-2xl text-white">
                Cancel
            </button>
            <button class="flex-1 bg-red-600 hover:bg-red-700 py-3 rounded-2xl text-white font-semibold">
                Delete
            </button>
        </div>
    </div>
</div>

<div id="logoutModal" class="fixed inset-0 bg-black/70 backdrop-blur-md hidden items-center justify-center z-[1000] p-4">
    <div class="bg-[#111] border border-white/10 rounded-3xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-white mb-4">
            Logout?
        </h2>
        <p class="text-gray-400 mb-8">
            You will need to login again.
        </p>
        <div class="flex gap-3">
            <button onclick="closeLogoutModal()" class="flex-1 border border-white/10 py-3 rounded-2xl text-white">
                Cancel
            </button>
            <form action="/logout" method="POST" class="flex-1">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-2xl text-white font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endauth

<style>

    .account-switch{
    flex:1;
    position:relative;
    padding:0 0 22px;
    font-size:18px;
    font-weight:700;
    color:#9ca3af;
    border-bottom:4px solid #d1d5db;
    transition:.3s ease;
}

.account-switch:hover{
    color:#111827;
}

.active-switch{
    color:#111827;
    border-bottom:4px solid #111827;
}

/* MOBILE */
@media(max-width:768px){

    .account-switch{
        font-size:16px;
        padding-bottom:18px;
    }

}
    .settings-tab {
        width: 100%;
        padding: 16px 18px;
        border-radius: 18px;
        text-align: left;
        font-weight: 600;
        color: #9ca3af;
        transition: .3s;
    }

    .settings-tab:hover {
        background: rgba(255, 255, 255, .05);
        color: white;
    }

    .active-settings-tab {
        background: rgba(239, 68, 68, .15);
        color: white;
        border: 1px solid rgba(239, 68, 68, .3);
    }
    
    /* MOBILE SETTINGS */
@media(max-width:768px){

    .settings-tab{
        padding:12px 10px;
        font-size:12px;
        border-radius:14px;
        line-height:1.4;
    }

    #settingsBox h2{
        font-size:18px !important;
        line-height:1.2;
    }

    #settingsBox input{
        font-size:14px;
        padding:14px 16px;
    }

}
</style>

<script>
    function showTab(tab){

    const ordersContent =
        document.getElementById('orders-content');

    const wishlistContent =
        document.getElementById('wishlist-content');

    const ordersTab =
        document.getElementById('tab-orders');

    const wishlistTab =
        document.getElementById('tab-wishlist');

    // reset
    ordersContent.classList.add('hidden');
    wishlistContent.classList.add('hidden');

    ordersTab.classList.remove('active-switch');
    wishlistTab.classList.remove('active-switch');

    // active
    if(tab === 'orders'){

        ordersContent.classList.remove('hidden');

        ordersTab.classList.add('active-switch');

    } else {

        wishlistContent.classList.remove('hidden');

        wishlistTab.classList.add('active-switch');
    }
}

    function openSettings() {
        const modal = document.getElementById('settingsModal');
        const box = document.getElementById('settingsBox');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
        }, 50);
    }

    function closeSettings() {
        const modal = document.getElementById('settingsModal');
        const box = document.getElementById('settingsBox');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }, 200);
    }

    function switchSettingsTab(tab) {
        const tabs = ['profile', 'security', 'orders', 'wishlist'];
        tabs.forEach(item => {
            document.getElementById('settings-' + item).classList.add('hidden');
            document.getElementById('settings-' + item + '-btn').classList.remove('active-settings-tab');
        });
        document.getElementById('settings-' + tab).classList.remove('hidden');
        document.getElementById('settings-' + tab + '-btn').classList.add('active-settings-tab');
    }

    function openDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    const settingsModal = document.getElementById('settingsModal');

if (settingsModal) {

    settingsModal.addEventListener('click', function(e) {

        if (e.target === this) {

            closeSettings();

        }

    });

}

document.addEventListener('DOMContentLoaded', function () {

    const urlParams = new URLSearchParams(window.location.search);

    const activeTab = urlParams.get('tab');

    if(activeTab === 'wishlist'){

        showTab('wishlist');

    }

});

</script>
@endsection