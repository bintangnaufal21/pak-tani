<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dabu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/riwayat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dataseller.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sellerdetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/pesanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/keuangan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/laporan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/pengaturan.css') }}">
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="admin-sidebar fixed left-0 top-0 h-screen">
        <div class="brand p-4">
            <div class="logo">A</div>
            <div>
                <h1>Admin Panel</h1>
                <span class="muted">Agro Mart</span>
            </div>
        </div>

        <ul class="nav-list mt-6">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="icon">📊</span> Dashboard</a>
            </li>
            <li><a href="{{ route('admin.buyer') }}" class="nav-link"><span class="icon">🧑‍🤝‍🧑</span> Data
                    Buyer</a></li>
            <li><a href="{{ route('admin.dataseller') }}" class="nav-link"><span class="icon">🏬</span> Data
                    Seller</a></li>
            <li><a href="{{ route('admin.keuangan') }}" class="nav-link"><span class="icon">💰</span> Keuangan</a>
            </li>
            <li><a href="{{ route('admin.laporan') }}" class="nav-link"><span class="icon">📑</span> Laporan</a></li>
            <li><a href="{{ route('admin.orders') }}" class="nav-link"><span class="icon">📑</span> Order</a></li>
            <li><a href="{{ route('admin.pengaturan') }}" class="nav-link"><span class="icon">⚙️</span>
                    Pengaturan</a></li>
        </ul>
    </aside>

    {{-- Topbar (right) --}}
    <div class="ml-64 p-4 bg-white shadow-sm flex items-center justify-end">
        <div class="flex items-center gap-4">
            <x-notification-bell />
            <div class="text-sm">{{ auth()->user()->name }}</div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="px-3 py-1 rounded bg-red-600 text-white">Logout</button>
            </form>
        </div>
    </div>


        {{ $slot }}


</body>

</html>
