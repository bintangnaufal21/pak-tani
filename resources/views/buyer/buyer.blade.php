<x-layoutBuyer title="Beranda Buyer">

    <!-- HERO / BANNER -->
    <header class="hero">
        <div class="hero-text">
            <h1>AGRO MART</h1>
            <p>Grow your agro's with us</p>
            <a href="{{ route('buyer.produk') }}" class="btn-shop">Shop Now</a>
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
                        <a href="{{ route('buyer.produk.detail', $product->id) }}">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/200x150?text=Produk" alt="{{ $product->name }}">
                            @endif
                            <h4>{{ $product->name }}</h4>
                        </a>

                        <p class="price">
                            Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}
                        </p>
                        <p class="stock">
                            Stok: {{ $product->stock }} {{ $product->unit }}
                        </p>

                        <div class="product-actions">
                            <a href="{{ route('buyer.produk.detail', $product->id) }}" class="btn-detail">
                                Lihat Detail
                            </a>
                            <form action="{{ route('buyer.keranjang.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-cart">+ Keranjang</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>


</x-layoutBuyer>
