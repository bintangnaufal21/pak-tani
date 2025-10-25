<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pak Tani</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex h-screen bg-gray-200">

        <aside class="w-64 bg-gray-800 text-white p-4 hidden md:block">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-green-400">Pak Tani</h2>
                <span class="text-sm text-gray-400">Admin Panel</span>
            </div>

            <nav>
                <a href="/dashboard" class="block py-2 px-4 rounded transition duration-200 bg-gray-700 text-white">
                    Dashboard
                </a>
                <a href="#" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Produk
                </a>
                <a href="#" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Petani (Seller)
                </a>
                <a href="#" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Pembeli (Buyer)
                </a>
                <a href="#" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Pesanan
                </a>
                <a href="#" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Pengaturan
                </a>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="bg-white shadow-md p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1> <div>
                        <span class="text-gray-700">Selamat datang, Admin!</span>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">

                    @yield('content') </div>
            </main>
            <footer class="bg-white p-4 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} Pak Tani. Hak Cipta Dilindungi.
            </footer>
            </div>
        </div>

</body>
</html>
