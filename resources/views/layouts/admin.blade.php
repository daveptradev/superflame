<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superflame Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            background:#070707;
        }

        .sidebar-link{
            position:relative;
            display:flex;
            align-items:center;
            gap:12px;
            padding:14px 16px;
            border-radius:14px;
            color:#9ca3af;
            transition:all .25s ease;
            overflow:hidden;
        }

        .sidebar-link:hover{
            background:rgba(239,68,68,.08);
            color:white;
            transform:translateX(4px);
        }

        .sidebar-link.active{
            background:linear-gradient(
                90deg,
                rgba(239,68,68,.18),
                rgba(239,68,68,.05)
            );

            color:white;
            border:1px solid rgba(239,68,68,.25);
        }

        .sidebar-link.active::before{
            content:'';
            position:absolute;
            left:0;
            top:10px;
            bottom:10px;
            width:3px;
            background:#ef4444;
            border-radius:999px;
        }
    </style>
</head>

<body class="text-white font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-[#0b0b0b] border-r border-white/5 flex flex-col">

        <!-- LOGO -->
        <div class="h-24 flex items-center px-8 border-b border-white/5">

            <img src="{{ asset('assets/sflamered.png') }}"
                 class="h-14">

        </div>

        <!-- MENU -->
        <div class="flex-1 px-5 py-6 space-y-2">

            <!-- DASHBOARD -->
            <a href="/admin/dashboard"
               class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-10h8V3h-8v8z"/>
                </svg>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>

            <!-- PRODUCTS -->
            <a href="/admin/products"
               class="sidebar-link {{ request()->is('admin/products') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                </svg>

                <span class="font-medium">
                    Products
                </span>

            </a>

            <!-- ORDERS -->
            <a href="/admin/orders"
               class="sidebar-link {{ request()->is('admin/orders') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5a3 3 0 016 0"/>
                </svg>

                <span class="font-medium">
                    Orders
                </span>

            </a>

            <!-- LIVESETS -->
            <a href="/admin/livesets"
               class="sidebar-link {{ request()->is('admin/livesets') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M9 19V6l12-2v13"/>
                </svg>

                <span class="font-medium">
                    Livesets
                </span>

            </a>

            <!-- EVENTS -->
             <a href="/admin/events"
class="sidebar-link {{ request()->is('admin/events') ? 'active' : '' }}">

    <!-- ICON -->
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.8"
            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
    </svg>

    <span>Events</span>

</a>

        </div>

        <!-- BOTTOM -->
        <div class="p-5 border-t border-white/5">

            <div class="bg-white/[0.03] border border-white/5 rounded-2xl p-4">

                <p class="text-sm text-gray-400">
                    Logged in as
                </p>

                <p class="font-semibold mt-1">
                    {{ auth()->user()->name }}
                </p>

                <form action="/logout"
                      method="POST"
                      class="mt-4">

                    @csrf

                    <button
                        class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-xl text-sm font-semibold transition">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <div class="h-24 border-b border-white/5 px-10 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-bold tracking-wide">
                    ADMIN PANEL
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Superflame Collective Management
                </p>
            </div>

            <div class="flex items-center gap-4">

                <!-- STATUS -->
                <div class="flex items-center gap-2 bg-white/[0.03] border border-white/5 px-4 py-2 rounded-xl">

                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>

                    <span class="text-sm text-gray-300">
                        System Online
                    </span>

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-10">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>