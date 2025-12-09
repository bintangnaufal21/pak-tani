@props(['title' => 'Dashboard Seller'])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Safety for disabled buttons */
        button[disabled],
        button[aria-disabled="true"] {
            opacity: 0.6;
            pointer-events: none;
            cursor: not-allowed;
        }

        /* Small improvements */
        .js-ship-form button {
            transition: opacity .15s ease, transform .08s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-lg fixed">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-green-700">🌿 Pak Tani</h1>
                <p class="text-xs text-gray-500 -mt-1">Penjualan Hasil Panen</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('seller.dashboard') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('seller.dashboard') ? 'bg-green-100 font-bold' : '' }}">
                    🌾 Dashboard
                </a>
                <a href="{{ route('seller.produk.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('seller.produk.*') ? 'bg-green-100 font-bold' : '' }}">
                    📦 Produk
                </a>
                <a href="{{ route('seller.orders.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('seller.orders.*') ? 'bg-green-100 font-bold' : '' }}">
                    🛒 Pesanan
                </a>
                <a href="{{ route('seller.history') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('seller.history') ? 'bg-green-100 font-bold' : '' }}">
                    📊 Riwayat Penjualan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <div class="flex justify-between items-center mb-6">

                <h2 class="text-3xl font-bold text-gray-800">{{ $title }}</h2>

                {{-- RIGHT: notifications + USER DROPDOWN --}}
                <div class="flex items-center gap-4">

                    <div class="mr-3 inline-block align-middle">
                        <x-notification-bell />
                    </div>
                    {{-- USER DROPDOWN --}}
                    <div class="relative">
                        <button id="user-menu-button" type="button"
                            class="flex items-center gap-2 bg-white px-3 py-2 rounded-full shadow hover:bg-gray-50">
                            <div
                                class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="user-menu-dropdown"
                            class="hidden absolute right-0 mt-2 w-44 bg-white shadow-lg border rounded-lg overflow-hidden z-20">

                            <a href="{{ route('seller.profil') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                👤 Profil
                            </a>

                            <a href="{{ route('buyer.home') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                🏠 Ke Buyer
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600 text-sm">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{ $slot }}
        </main>
    </div>

    {{-- SCRIPT DROPDOWN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('user-menu-button');
            const menu = document.getElementById('user-menu-dropdown');

            if (!btn || !menu) return;

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // klik di luar -> tutup menu
            document.addEventListener('click', function() {
                menu.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
