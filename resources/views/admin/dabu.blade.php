<x-layoutAdmin title="Data Buyer Admin">
  <!-- PAGE CONTENT -->
  <main class="main">
      <h2>Data Buyer</h2>

      <div class="table-wrapper">
        <table class="buyer-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Buyer</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>Budi Santoso</td>
                <td>budi@gmail.com</td>
                <td>081234567890</td>
                <td><a href="#popup-riwayat" class="btn-riwayat">Riwayat</a></td>
              </tr>

              <tr>
                <td>2</td>
                <td>Ayu Lestari</td>
                <td>ayu@gmail.com</td>
                <td>081298765432</td>
                <td><a href="#popup-riwayat" class="btn-riwayat">Riwayat</a></td>
              </tr>

              <tr>
                <td>3</td>
                <td>Rudi Hartono</td>
                <td>rudi@gmail.com</td>
                <td>081223344556</td>
                <td><a href="#popup-riwayat" class="btn-riwayat">Riwayat</a></td>
              </tr>
            </tbody>
        </table>
      </div>
  </main>


  <!-- ========================== -->
  <!--       POPUP RIWAYAT       -->
  <!-- ========================== -->
  <div id="popup-riwayat" class="modal">
    <div class="modal-box">

      <a href="#" class="close-btn">&times;</a>

      <h3>Riwayat Pembelian Buyer</h3>

      <table class="riwayat-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>12 Jan 2025</td>
            <td>Beras Premium</td>
            <td>2</td>
            <td>Rp 120.000</td>
          </tr>

          <tr>
            <td>20 Jan 2025</td>
            <td>Sayur Organik</td>
            <td>5</td>
            <td>Rp 75.000</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</x-layoutAdmin>
