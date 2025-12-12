<x-layoutAdmin title="Laporan Admin">
    <main class="main">

        <h2>Laporan</h2>

        {{-- LAPORAN TRANSAKSI --}}
        <div class="table-wrapper">
            <h3>Laporan Transaksi</h3>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Buyer</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporanTransaksi as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ optional($t->order)->receiver_name ?? (optional($t->order->user)->name ?? '-') }}</td>
                            <td>{{ optional($t->product)->name ?? '-' }}</td>
                            <td>{{ $t->quantity }}</td>
                            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td>{{ $t->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- LAPORAN PENJUALAN --}}
        <div class="table-wrapper">
            <h3>Laporan Penjualan Seller</h3>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Seller</th>
                        <th>Produk Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporanPenjualan as $i => $l)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $l->seller_name }}</td>
                            <td>{{ $l->produk_terjual }}</td>
                            <td>Rp {{ number_format($l->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</x-layoutAdmin>
