<x-layoutAdmin title="Dashboard Admin">
    <!-- MAIN CONTENT -->
    <main class="main">
        <h1 class="page-title">Dashboard</h1>

        <!-- GRID SUMMARY -->
        <div class="grid-summary">
            <div class="card">
                <h3>Total Pesanan</h3>
                <p class="number">152</p>
            </div>

            <div class="card">
                <h3>Total Buyer</h3>
                <p class="number">87</p>
            </div>

            <div class="card">
                <h3>Total Seller</h3>
                <p class="number">34</p>
            </div>

            <div class="card">
                <h3>Total Penjualan</h3>
                <p class="number">Rp 12.540.000</p>
            </div>

            <div class="card">
                <h3>Total Transaksi</h3>
                <p class="number">198</p>
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
                <tr>
                    <td>#00152</td>
                    <td>Rina</td>
                    <td>Toko Maju</td>
                    <td>Rp 240.000</td>
                    <td><span class="status selesai">Selesai</span></td>
                </tr>

                <tr>
                    <td>#00151</td>
                    <td>Budi</td>
                    <td>Pertanian Sejahtera</td>
                    <td>Rp 150.000</td>
                    <td><span class="status dikirim">Dikirim</span></td>
                </tr>

                <tr>
                    <td>#00150</td>
                    <td>Ani</td>
                    <td>Toko Sayur</td>
                    <td>Rp 90.000</td>
                    <td><span class="status proses">Diproses</span></td>
                </tr>
            </tbody>
        </table>
    </main>
</x-layoutAdmin>
