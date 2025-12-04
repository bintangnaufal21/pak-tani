<x-layoutSeller title="Pesanan">

    <div class="max-w-6xl mx-auto space-y-4">

        {{-- KARTU TABEL --}}
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

            @if ($orders->isEmpty())
                <p class="text-center text-gray-500 py-8">
                    Belum ada pesanan untuk produkmu.
                </p>
            @else
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b text-gray-600">
                            <th class="py-3 px-5 w-1/3">Nama Pembeli</th>
                            <th class="py-3 px-5 w-1/6 text-center">Jumlah Produk</th>
                            <th class="py-3 px-5 w-1/6 text-right">Total Harga</th>
                            <th class="py-3 px-5 w-1/4 text-center">Status Pembayaran</th>
                            <th class="py-3 px-5 w-1/6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y">
                        @foreach ($orders as $order)
                            @php
                                $sellerId = auth()->id();
                                $sellerItems = $order->items->filter(
                                    fn($item) => optional($item->product)->user_id == $sellerId,
                                );

                                $totalQty = $sellerItems->sum('quantity');
                                $totalPrice = $sellerItems->sum('total');

                                $buyerName = $order->receiver_name ?? ($order->user->name ?? '-');

                                $pay = strtolower(trim($order->payment_status ?? ''));
                                $statusLabel = match ($pay) {
                                    'paid' => 'Sudah Dibayar',
                                    'rejected' => 'Pembayaran Ditolak',
                                    'waiting_verification' => 'Menunggu Verifikasi',
                                    default => 'Menunggu Pembayaran',
                                };

                                $statusClass = match ($pay) {
                                    'paid' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    'waiting_verification' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50/70">
                                <td class="py-3 px-5">
                                    <div class="font-semibold">{{ $buyerName }}</div>
                                    <div class="text-xs text-gray-500">
                                        Kode: {{ $order->order_code }}
                                    </div>
                                </td>

                                <td class="py-3 px-5 text-center">
                                    {{ $totalQty }} item
                                </td>

                                <td class="py-3 px-5 text-right">
                                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                </td>

                                <td class="py-3 px-5 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td class="py-3 px-5 text-center">
                                    <a href="{{ route('seller.orders.show', $order->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold bg-green-600 text-white hover:bg-green-700 transition">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

</x-layoutSeller>
