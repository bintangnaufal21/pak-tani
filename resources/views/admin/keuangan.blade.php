<x-layoutAdmin title="Keuangan Admin">
  <!-- PAGE CONTENT -->
  <main class="main">
      <h2>Keuangan / Transaksi</h2>

      <!-- DANA MASUK -->
      <div class="table-wrapper">
        <h3>Dana Masuk dari Buyer</h3>
        <table class="finance-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Buyer</th>
              <th>Produk</th>
              <th>Jumlah</th>
              <th>Total Harga</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Budi Santoso</td>
              <td>Beras Premium</td>
              <td>2</td>
              <td>Rp 120.000</td>
              <td>Paid</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ayu Lestari</td>
              <td>Sayur Organik</td>
              <td>5</td>
              <td>Rp 75.000</td>
              <td>Paid</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- DANA KE SELLER -->
      <div class="table-wrapper">
        <h3>Dana yang Harus Diteruskan ke Seller</h3>
        <table class="finance-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Seller</th>
              <th>Total Dana</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Toko Maju Jaya</td>
              <td>Rp 120.000</td>
              <td>Pending</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Toko Subur Makmur</td>
              <td>Rp 75.000</td>
              <td>Pending</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- BUKTI PEMBAYARAN / RIWAYAT -->
      <div class="table-wrapper">
        <h3>Riwayat Transaksi</h3>
        <table class="finance-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Buyer</th>
              <th>Produk</th>
              <th>Total Harga</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Budi Santoso</td>
              <td>Beras Premium</td>
              <td>Rp 120.000</td>
              <td>12 Jan 2025</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ayu Lestari</td>
              <td>Sayur Organik</td>
              <td>Rp 75.000</td>
              <td>20 Jan 2025</td>
            </tr>
          </tbody>
        </table>
      </div>

  </main>
</x-layoutAdmin>
