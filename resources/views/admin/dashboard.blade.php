<x-layoutAdmin title="Dashboard Admin">

    <main class="main">
        <h1 class="page-title">Dashboard</h1>

        <!-- GRID SUMMARY -->
        <div class="grid-summary">
            <div class="card">
                <h3>Total Pesanan</h3>
                <p class="number">{{ $totalOrders }}</p>
            </div>

            <div class="card">
                <h3>Total Buyer</h3>
                <p class="number">{{ $totalBuyer }}</p>
            </div>

            <div class="card">
                <h3>Total Seller</h3>
                <p class="number">{{ $totalSeller }}</p>
            </div>

            <div class="card">
                <h3>Total Penjualan</h3>
                <p class="number">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>

            <div class="card">
                <h3>Total Transaksi</h3>
                <p class="number">{{ $totalTransactions }}</p>
            </div>
        </div>

        <h2 class="section-title">Pesanan Terbaru</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Buyer</th>
                    <th>Seller</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($latestOrders as $order)
                    @php
                        // Ambil salah satu seller dari item produk
                        $sellerName = optional(optional($order->items->first())->product->user)->name ?? '-';
                    @endphp

                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>{{ $sellerName }}</td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = strtolower($order->status);

                                $class = match ($status) {
                                    'pending' => 'status-badge status-pending',
                                    'paid' => 'status-badge status-paid',
                                    'processing' => 'status-badge status-processing',
                                    'shipped' => 'status-badge status-shipped',
                                    'completed' => 'status-badge status-completed',
                                    'cancelled' => 'status-badge status-cancelled',
                                    default => 'status-badge status-pending',
                                };
                            @endphp

                            <span class="{{ $class }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

</x-layoutAdmin>
