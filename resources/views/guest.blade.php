<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Dashboard</title>
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

    <!-- HERO / BANNER -->
    <header class="hero">
        <div class="hero-text">
            <h1>AGRO MART</h1>
            <p>Grow your agro's with us</p>
            <a href="{{ route('guest') }}" class="btn-shop">Shop Now</a>
        </div>
        <img src="{{ asset('images/1.png') }}" alt="Organic Food">
    </header>

    <!-- BANNER SECTION -->
    <section class="banner-section">
        <div class="banner-card">
            <img src="{{ asset('images/2.jpeg') }}" alt="Banner 2">
        </div>
        <div class="banner-card">
            <img src="{{ asset('images/3.jpeg') }}" alt="Banner 3">
        </div>
    </section>

    <!-- PRODUCT LIST -->
    <section class="products">
        <h2>Our Products</h2>

        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">

                        @if ($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/200x150?text=Produk" alt="{{ $product->name }}">
                        @endif
                        <h4>{{ $product->name }}</h4>


                        <p class="price">
                            Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}
                        </p>
                        <p class="stock">
                            Stok: {{ $product->stock }} {{ $product->unit }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>







    <nav class="bottom-nav">
        <a href="{{ route('guest') }}" class="{{ request()->routeIs('guest') ? 'active' : '' }}">
            🏠<span>Beranda</span>
        </a>

        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
            👤<span>Login</span>
        </a>
    </nav>


</body>

</html>
