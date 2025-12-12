<x-layoutAdmin title="Keuangan Admin">
    <main class="main">
        <h2>Keuangan / Transaksi</h2>

        {{-- INCOMING ORDERS --}}
        <div class="card mb-6 p-4">
            <h3>Pesanan Terbaru</h3>

            @if ($incomingOrders->isEmpty())
                <p class="muted">Belum ada pesanan terbaru.</p>
            @else
                <table class="w-full">
                    <thead class="bg-green-50">
                        <tr>
                            <th style="padding:8px;">No</th>
                            <th style="padding:8px;">Kode</th>
                            <th style="padding:8px;">Pembeli</th>
                            <th style="padding:8px;">Total</th>
                            <th style="padding:8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomingOrders as $i => $order)
                            <tr class="@if ($i % 2) bg-white @else bg-gray-50 @endif">
                                <td style="padding:8px;">{{ $i + 1 }}</td>
                                <td style="padding:8px;">{{ $order->order_code }}</td>
                                <td style="padding:8px;">{{ $order->receiver_name ?? $order->user->name }}</td>
                                <td style="padding:8px;">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                                <td style="padding:8px;">{{ ucfirst($order->payment_status ?? $order->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- DANA YANG HARUS DITERUSKAN --}}
        <div class="card mb-6 p-4">
            <h3>Dana yang Harus Diteruskan ke Seller</h3>

            <table class="w-full">
                <thead class="bg-green-50">
                    <tr>
                        <th style="padding:8px;">No</th>
                        <th style="padding:8px;">Nama Seller</th>
                        <th style="padding:8px;">Rekening</th>
                        <th style="padding:8px;">Total Dana</th>
                        <th style="padding:8px;">Total Setelah Potongan Admin</th>
                        <th style="padding:8px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellerRows as $i => $s)
                        <tr class="{{ $i % 2 ? 'bg-gray-50' : 'bg-white' }}">
                            <td style="padding:8px;">{{ $i + 1 }}</td>
                            <td style="padding:8px;">{{ $s->name ?? '-' }}</td>
                            <td style="padding:8px;">
                                {{ $s->bank_name ?? '-' }}<br>
                                {{ $s->bank_account_number ?? '-' }}
                            </td>
                            <td style="padding:8px;">Rp {{ number_format($s->total ?? 0, 0, ',', '.') }}</td>
                            <td style="padding:8px;">
                                Rp {{ number_format($s->after_fee ?? 0, 0, ',', '.') }}<br>
                                <small>Potongan admin: Rp {{ number_format($s->admin_fee ?? 0, 0, ',', '.') }}</small>
                            </td>
                            <td style="padding:8px;">
                                {{-- Jika sudah ada payout aktif, disable form --}}
                                @if ($s->hasActivePayout)
                                    <div class="mb-2">
                                        <span class="px-3 py-1 rounded-full bg-gray-200 text-sm">Sudah Diteruskan</span>
                                    </div>

                                    @if ($s->lastPayout && $s->lastPayout->proof)
                                        <a href="{{ asset('storage/' . $s->lastPayout->proof) }}" target="_blank"
                                            class="text-sm underline">Lihat bukti</a>
                                    @endif
                                @else
                                    <form action="{{ url('admin/keuangan/payout/' . $s->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div style="margin-bottom:6px;">
                                            <label style="font-size:12px; display:block; margin-bottom:4px;">Bukti
                                                Transfer (jpg/png/pdf)</label>
                                            <input type="file" name="proof" required>
                                        </div>

                                        {{-- kirim jumlah total (server sudah hitung) --}}
                                        <input type="hidden" name="amount" value="{{ $s->total }}">

                                        <button class="btn btn-success" type="submit">
                                            Teruskan Dana
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- RIWAYAT TRANSAKSI --}}
        <div class="card p-4">
            <h3>Riwayat Transaksi</h3>
            @if ($transactions->isEmpty())
                <p class="muted">Belum ada transaksi.</p>
            @else
                <table class="w-full">
                    <thead class="bg-green-50">
                        <tr>
                            <th style="padding:8px;">No</th>
                            <th style="padding:8px;">Buyer</th>
                            <th style="padding:8px;">Produk</th>
                            <th style="padding:8px;">Total Harga</th>
                            <th style="padding:8px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $i => $t)
                            <tr>
                                <td style="padding:8px;">{{ $i + 1 }}</td>
                                <td style="padding:8px;">{{ optional($t->order)->receiver_name ?? '-' }}</td>
                                <td style="padding:8px;">{{ optional($t->product)->name ?? '-' }}</td>
                                <td style="padding:8px;">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                <td style="padding:8px;">{{ optional($t->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </main>
</x-layoutAdmin>
