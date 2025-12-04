<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'Buyer Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('css/buyer/buyer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/bottom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/co.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/keranjang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/pesanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/bottom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/dp.css') }}">
</head>

<body>

    {{ $slot }}

    <nav class="bottom-nav">
        <a href="{{ route('buyer.home') }}" class="{{ request()->routeIs('buyer.home') ? 'active' : '' }}">
            🏠<span>Beranda</span>
        </a>

        <a href="{{ route('buyer.produk') }}" class="{{ request()->routeIs('buyer.produk') ? 'active' : '' }}">
            🛍️<span>Produk</span>
        </a>

        <a href="{{ route('buyer.keranjang') }}" class="{{ request()->routeIs('buyer.keranjang') ? 'active' : '' }}">
            🛒<span>Keranjang</span>
        </a>

        <a href="{{ route('buyer.pesanan') }}" class="{{ request()->routeIs('buyer.pesanan') ? 'active' : '' }}">
            📦<span>Pesanan</span>
        </a>

        <a href="{{ route('buyer.profile') }}" class="{{ request()->routeIs('buyer.profile') ? 'active' : '' }}">
            👤<span>Profil</span>
        </a>
    </nav>


</body>

</html>
