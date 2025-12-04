<x-layoutBuyer title="Produk Pertanian">

    <!-- HEADER -->
    <header class="header">
        <h2>Produk Pertanian</h2>
        <p>Ayo lihat dan pilih segala hasil pertanian terbaik dari para petani kami</p>
    </header>

    <!-- PRODUCT LIST -->
    <section class="product-list">
        @if ($products->count() === 0)
            <p style="text-align:center; color:#6b7280; margin-top:1rem;">
                Belum ada produk yang tersedia.
            </p>
        @else
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">

                        <a href="{{ route('buyer.produk.detail', $product->id) }}">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/200x150?text=Produk" alt="{{ $product->name }}">
                            @endif

                            <h3>{{ $product->name }}</h3>
                        </a>

                        <p class="price">
                            Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}
                        </p>

                        <div class="product-actions">
                            <a href="{{ route('buyer.produk.detail', $product->id) }}" class="btn-detail">
                                Lihat Detail
                            </a>

                            <form action="{{ route('buyer.keranjang.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-cart">
                                    + Keranjang
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

            <div style="margin-top: 1rem;">
                {{ $products->links() }}
            </div>
        @endif
    </section>

</x-layoutBuyer>
