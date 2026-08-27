<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superflame Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0f0f0f] text-white">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-black border-r border-gray-800 p-6">

        <h1 class="text-xl font-bold text-red-500 mb-8">
            SUPERFLAME ADMIN
        </h1>

        <nav class="space-y-3 text-sm">

            <a href="/admin/dashboard" class="block hover:text-red-500">
                Dashboard
            </a>

            <a href="/admin/livesets" class="block hover:text-red-500">
                Livesets
            </a>

            <a href="/admin/products" class="block hover:text-red-500">
                Products
            </a>

            <a href="/admin/orders" class="block hover:text-red-500">
                Orders
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>
</html>