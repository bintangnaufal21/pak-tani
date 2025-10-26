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
                <h2 class="text-2xl font-bold text-green-400">PAK TANI</h2>
                <span class="text-sm text-gray-400">Admin Panel</span>
            </div>

            <nav>
    <a href="/dashboard"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Dashboard
    </a>

    <a href="/produk"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('produk*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Produk
    </a>

    <a href="#"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('petani*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Petani (Seller)
    </a>

    <a href="#"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('pembeli*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Pembeli (Buyer)
    </a>

    <a href="#"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('pesanan*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Pesanan
    </a>

    <a href="#"
       class="block py-2 px-4 rounded transition duration-200
              {{ Request::is('pengaturan*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Pengaturan
    </a>
</nav>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="bg-white shadow-md p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1> <div>
                        <span class="text-gray-700">Selamat datang, Admin!</span>
                        <a href="" class="px-2 pt-1 pb-2  bg-red-500 text-white rounded-md  hover:bg-red-600 transition duration-200">Logout</a>
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
