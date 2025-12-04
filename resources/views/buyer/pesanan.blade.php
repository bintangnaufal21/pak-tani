<x-layoutBuyer title="Pesanan Saya">

    <header class="top-header">
        <h2>Pesanan Saya</h2>
    </header>

    <div class="order-grid">

        @forelse($orders as $order)
            @php
                $firstItem = $order->items->first();
                $product = $firstItem?->product;

                $imgPath =
                    $product && $product->image_path
                        ? asset('storage/' . $product->image_path)
                        : asset('images/paprika.jpeg'); // fallback

                // STATUS PESANAN (proses / kirim / selesai / batal)
                $statusLabel = match ($order->status) {
                    'processing' => 'Diproses',
                    'pending' => 'Menunggu',
                    'paid' => 'Menunggu Dikirim',
                    'shipped' => 'Dikirim',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($order->status ?? 'Diproses'),
                };

                $statusClass = match ($order->status) {
                    'processing', 'pending' => 'status-pending',
                    'paid' => 'status-paid',
                    'shipped' => 'status-kirim',
                    'completed' => 'status-selesai',
                    'cancelled' => 'status-batal',
                    default => 'status-pending',
                };

                // STATUS PEMBAYARAN (dibayar / menunggu verifikasi / ditolak)
                $payLabel = match ($order->payment_status) {
                    'paid' => 'Sudah Bayar',
                    'waiting_verification' => 'Menunggu Verifikasi',
                    'rejected' => 'Pembayaran Ditolak',
                    default => 'Belum Dibayar',
                };

                $payClass = match ($order->payment_status) {
                    'paid' => 'pay-paid',
                    'waiting_verification' => 'pay-wait',
                    'rejected' => 'pay-reject',
                    default => 'pay-unpaid',
                };
            @endphp

            <div class="order-card">
                <img src="{{ $imgPath }}" alt="Produk">

                <h3>{{ $order->order_code ?? 'Pesanan #' . $order->id }}</h3>

                {{-- status pesanan (proses / dikirim / selesai) --}}
                <p class="badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </p>

                {{-- status pembayaran (belum bayar / sudah bayar) --}}
                <p class="badge badge-pay {{ $payClass }}">
                    {{ $payLabel }}
                </p>

                <p class="date">
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>

                <p class="total">
                    Total: <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </p>
                @if ($order->status === 'shipped')
                    <form action="{{ route('buyer.orders.complete', $order->id) }}" method="POST"
                        onsubmit="return confirm('Konfirmasi terima barang?')">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Terima &
                            Selesai</button>
                    </form>
                @endif
            </div>


        @empty

            <p class="empty-order">
                Kamu belum punya pesanan. Yuk belanja dulu 🌾
            </p>
        @endforelse

    </div>

    <style>
        .top-header {
            text-align: center;
            padding: 18px 0 10px;
            background: #e7f0dc;
            color: #597445;
        }

        .order-grid {
            padding: 24px 6% 90px;
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            justify-content: center;
        }

        .order-card {
            background: #fff;
            width: 230px;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .06);
            padding: 12px 14px 16px;
            text-align: center;
        }

        .order-card img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 6px;
        }

        .order-card h3 {
            margin: 4px 0 2px;
            font-size: 15px;
            font-weight: 700;
            color: #374151;
        }

        /* BADGE UMUM */
        .badge {
            font-size: 11px;
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            color: #fff;
            margin: 3px 3px 0;
        }

        /* status pesanan */
        .status-pending {
            background: #f59e0b;
        }

        .status-paid {
            background: #3b82f6;
        }

        .status-kirim {
            background: #22c55e;
        }

        .status-selesai {
            background: #16a34a;
        }

        .status-batal {
            background: #ef4444;
        }

        /* status pembayaran */
        .badge-pay {
            margin-top: 2px;
        }

        .pay-unpaid {
            background: #6b7280;
        }

        .pay-wait {
            background: #f97316;
        }

        .pay-paid {
            background: #16a34a;
        }

        .pay-reject {
            background: #dc2626;
        }

        .date {
            font-size: 12px;
            color: #6b7280;
            margin: 4px 0 2px;
        }

        .total {
            font-size: 13px;
            margin-top: 4px;
        }

        .total span {
            font-weight: 700;
            color: #16a34a;
        }

        .empty-order {
            text-align: center;
            color: #6b7280;
            width: 100%;
            margin-top: 30px;
        }
    </style>

</x-layoutBuyer>
