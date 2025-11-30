<x-layoutAdmin title="Laporan Admin">
  <!-- PAGE CONTENT -->
  <main class="main">
      <h2>Laporan</h2>

      <!-- LAPORAN TRANSAKSI -->
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
            <tr>
              <td>1</td>
              <td>Budi Santoso</td>
              <td>Beras Premium</td>
              <td>2</td>
              <td>Rp 120.000</td>
              <td>12 Jan 2025</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ayu Lestari</td>
              <td>Sayur Organik</td>
              <td>5</td>
              <td>Rp 75.000</td>
              <td>20 Jan 2025</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- LAPORAN PENJUALAN -->
      <div class="table-wrapper">
        <h3>Laporan Penjualan</h3>
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
            <tr>
              <td>1</td>
              <td>Toko Maju Jaya</td>
              <td>Beras Premium (2)</td>
              <td>Rp 120.000</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Toko Subur Makmur</td>
              <td>Sayur Organik (5)</td>
              <td>Rp 75.000</td>
            </tr>
          </tbody>
        </table>
      </div>

  </main>
</x-layoutAdmin>
