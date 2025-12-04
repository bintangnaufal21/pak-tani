<x-layoutSeller :title="'Detail Pesanan ' . $order->order_code">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI: INFO ORDER & ITEM --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Card info order --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">
                            Pesanan #{{ $order->order_code }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Dibuat pada: {{ $order->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    @php
                        $pay = strtolower(trim($order->payment_status ?? ''));
                        $payLabel = match ($pay) {
                            'paid' => 'Sudah Dibayar',
                            'rejected' => 'Pembayaran Ditolak',
                            'waiting_verification' => 'Menunggu Verifikasi',
                            default => 'Menunggu Pembayaran',
                        };
                        $payClass = match ($pay) {
                            'paid' => 'bg-green-100 text-green-700',
                            'rejected' => 'bg-red-100 text-red-700',
                            'waiting_verification' => 'bg-yellow-100 text-yellow-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $payClass }}">
                        {{ $payLabel }}
                    </span>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Nama Pembeli</h3>
                        <p class="text-gray-800">
                            {{ $order->receiver_name ?? ($order->user->name ?? '-') }}
                        </p>
                        <p class="text-gray-500">
                            📞 {{ $order->receiver_phone ?? ($order->user->email ?? '-') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Alamat Pengiriman</h3>
                        <p class="text-gray-800 whitespace-pre-line">
                            {{ $order->shipping_address ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- Card daftar produk milik seller --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">
                    Produk pada pesanan ini
                </h2>

                @if ($items->isEmpty())
                    <p class="text-sm text-gray-500">
                        Tidak ada produk milik toko Anda di pesanan ini.
                    </p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b text-gray-600">
                                <th class="py-2">Produk</th>
                                <th class="py-2">Qty</th>
                                <th class="py-2">Harga</th>
                                <th class="py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($items as $item)
                                <tr class="border-b">
                                    <td class="py-2">
                                        <div class="font-semibold">
                                            {{ $item->product->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        {{ $item->quantity }}
                                        {{ $item->product->unit ?? '' }}
                                    </td>
                                    <td class="py-2">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2">
                                        Rp {{ number_format($item->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- KANAN: RINGKASAN UNTUK SELLER --}}

        <div class="space-y-4">

            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="font-semibold text-gray-700 mb-2">Metode Pengiriman</h3>
                <p class="text-gray-800">
                    @php
                        $method = match ($order->shipping_method) {
                            'reguler' => 'Reguler (3–5 hari)',
                            'express' => 'Express (1–2 hari)',
                            'instant' => 'Instant (Tiba hari ini)',
                            default => ucfirst($order->shipping_method),
                        };
                    @endphp

                    {{ $method }}
                </p>
            </div>


            <div class="bg-white p-5 rounded-2xl shadow-sm border">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">
                    Ringkasan untuk Toko Anda
                </h2>

                <div class="flex justify-between text-sm mb-2">
                    <span>Nilai pesanan (produk Anda)</span>
                    <span class="font-semibold">
                        Rp {{ number_format($sellerTotal, 0, ',', '.') }}
                    </span>
                </div>

                <p class="text-xs text-gray-500 mt-2">
                    *Ini hanya nilai produk milik toko Anda dalam pesanan ini.
                    Bila buyer membeli dari beberapa toko, total keseluruhan lebih besar.
                </p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Aksi
                </h3>

                @if ($order->status === 'shipped')
                    <p class="text-sm text-green-700 font-semibold mb-2">
                        ✅ Pesanan ini sudah ditandai sebagai <span class="font-bold">Dikirim</span>.
                    </p>

                    @if ($order->shipped_at)
                        <p class="text-xs text-gray-500">Dikirim pada: {{ $order->shipped_at->format('d M Y H:i') }}
                        </p>
                    @endif
                @else
                    @if ($order->payment_status !== 'paid')
                        <p class="text-xs text-gray-500 mb-3">
                            Pesanan belum diverifikasi sebagai sudah dibayar oleh admin.
                            Tombol kirim akan aktif setelah status pembayaran <strong>Sudah Dibayar</strong>.
                        </p>
                    @endif

                    @php
                        // normalisasi status
                        $statusNormalized = strtolower(trim($order->status ?? ''));
                        // aktifkan tombol hanya jika status persis 'paid'
                        $canShip = $statusNormalized === 'paid';
                    @endphp

                    <form id="ship-form-{{ $order->id }}" action="{{ route('seller.orders.ship', $order->id) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-all disabled:opacity-60"
                            @if (!$canShip) disabled aria-disabled="true" title="Tombol aktif hanya ketika status pesanan 'paid'." @endif>
                            @if ($order->status === 'shipped')
                                ✅ Sudah Dikirim
                            @elseif ($order->status === 'completed')
                                ✅ Selesai
                            @else
                                Konfirmasi Kirim
                            @endif
                        </button>
                    </form>


                @endif
            </div>


        </div>
    </div>
</x-layoutSeller>
