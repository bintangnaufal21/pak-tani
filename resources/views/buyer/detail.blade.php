<x-layoutBuyer :title="$product->name">

    <section class="detail-wrapper">

        <div class="detail-card">

            {{-- KIRI: GAMBAR PRODUK --}}
            <div class="detail-left">
                @if ($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="detail-img">
                @else
                    <img src="https://via.placeholder.com/400x260?text=Produk" alt="{{ $product->name }}"
                        class="detail-img">
                @endif
            </div>

            {{-- KANAN: INFO PRODUK --}}
            <div class="detail-right">

                <p class="detail-badge">Produk Pertanian</p>

                <h1 class="detail-title">{{ $product->name }}</h1>

                <p class="detail-price">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <span class="detail-unit">/ {{ $product->unit }}</span>
                </p>

                <p class="detail-stock">
                    Stok tersedia:
                    <span>{{ $product->stock }} {{ $product->unit }}</span>
                </p>

                <p class="detail-desc">
                    {{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}
                </p>

                {{-- INFO TOKO --}}
                <div class="detail-seller">
                    <div class="seller-avatar">
                        {{ strtoupper(substr($product->seller->store_name ?? ($product->seller->name ?? 'T'), 0, 1)) }}
                    </div>
                    <div class="seller-text">
                        <p class="seller-name">
                            {{ $product->seller->store_name ?? ($product->seller->name ?? 'Toko Petani') }}</p>
                        <p class="seller-location">
                            📍 {{ $product->seller->address ?? 'Lokasi belum diisi' }}
                        </p>
                    </div>
                </div>

                {{-- FORM TAMBAH KE KERANJANG --}}
                <form action="{{ route('buyer.keranjang.add', $product->id) }}" method="POST" class="detail-form">
                    @csrf

                    <div class="detail-qty">
                        <label for="qty">Jumlah</label>
                        <input type="number" id="qty" name="quantity" min="1" max="{{ $product->stock }}"
                            value="1">
                        <span>{{ $product->unit }}</span>
                    </div>

                    <div class="detail-actions">
                        <a href="{{ route('buyer.produk') }}" class="btn-outline">
                            ← Kembali ke Produk
                        </a>

                        <button type="submit" class="btn-primary">
                            🛒 Tambah ke Keranjang
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </section>

</x-layoutBuyer>
