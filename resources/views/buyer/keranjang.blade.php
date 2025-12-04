<x-layoutBuyer title="Keranjang Saya">

    <section class="cart-page">

        <h2 class="cart-title">Keranjang Belanja</h2>

        <div class="cart-grid">

            {{-- LIST PRODUK --}}
            <div class="cart-items">

                @forelse($items as $item)
                    <div class="cart-card">

                        <img
                            src="{{ $item->product->image_path ? asset('storage/' . $item->product->image_path) : 'https://via.placeholder.com/80' }}">

                        <div class="cart-info">
                            <h3>{{ $item->product->name }}</h3>
                            <p class="price">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            <p class="qty">Qty: <strong>{{ $item->quantity }} {{ $item->product->unit }}</strong></p>
                        </div>

                        {{-- 🔺 AREA ACTIONS (QTY + DELETE) --}}
                        <div class="cart-actions">

                            {{-- minus / plus qty --}}
                            <form action="{{ route('buyer.keranjang.update', $item->id) }}" method="POST"
                                class="qty-box">
                                @csrf
                                @method('PATCH')

                                <button type="submit" name="type" value="minus" class="qty-btn">−</button>
                                <span>{{ $item->quantity }}</span>
                                <button type="submit" name="type" value="plus" class="qty-btn">+</button>
                            </form>

                            {{-- hapus item --}}
                            <form action="{{ route('buyer.keranjang.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">🗑</button>
                            </form>

                        </div>


                    </div>
                @empty
                    <p class="empty-cart">Keranjang masih kosong, yuk belanja dulu 🌾</p>
                @endforelse


            </div>

            {{-- SUMMARY --}}
            <div class="cart-summary">

                <h3>Ringkasan Pesanan</h3>

                <p class="sum-row"><span>Subtotal</span> <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></p>

                <hr>

                <p class="sum-total"><span>Total</span> <strong>Rp
                        {{ number_format($subtotal) }}</strong></p>

                <a href="{{ route('buyer.checkout') }}" class="checkout-btn">Checkout Sekarang</a>

            </div>

        </div>
    </section>

    <style>
        .cart-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin: 25px 0;
            color: #466536;
        }

        .cart-page {
            padding: 20px 8%;
        }

        /* GRID UTAMA */
        .cart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        /* ITEM DI KIRI */
        .cart-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
            margin-bottom: 15px;
        }

        .cart-card img {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
        }

        .cart-info h3 {
            margin: 0 0 4px;
            font-size: 18px;
            font-weight: 600;
        }

        .price {
            color: #368438;
            font-weight: 600;
        }

        .qty {
            font-size: 13px;
            color: #666
        }

        /* SUMMARY */
        .cart-summary {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .sum-row,
        .sum-total {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .sum-total strong {
            font-size: 18px;
            color: #2e6d32
        }

        .checkout-btn {
            display: block;
            margin-top: 18px;
            background: #22c55e;
            text-align: center;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background: #19a74e
        }
    </style>

</x-layoutBuyer>
