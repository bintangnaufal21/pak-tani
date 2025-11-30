<x-layoutAdmin title="Detail Seller">
  <!-- PAGE CONTENT -->
  <main class="main">

    <h2>Detail Seller</h2>

    <!-- INFORMASI SELLER -->
    <div class="seller-box">
        <h3>Informasi Seller</h3>

        <div class="info-row">
            <div class="info-item">
                <label>Nama Toko:</label>
                <p>Toko Maju Jaya</p>
            </div>

            <div class="info-item">
                <label>Email:</label>
                <p>maju@gmail.com</p>
            </div>

            <div class="info-item">
                <label>No HP:</label>
                <p>081234567890</p>
            </div>

            <div class="info-item">
                <label>Status Toko:</label>

                <form method="GET" action="#" class="status-form">
                    <select>
                      <option value="aktif">Aktif</option>
                      <option value="non">Non-Aktif</option>
                    </select>

                    <button type="submit" class="btn-save-status">Simpan</button>
                </form>

            </div>
        </div>
    </div>




    <!-- DAFTAR PRODUK SELLER -->
    <div class="product-box">
        <h3>Produk yang Dijual</h3>

        <table class="product-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>Beras Premium 5kg</td>
                <td>Rp 60.000</td>
                <td>40</td>
                <td><a href="#" class="btn-delete">Hapus</a></td>
              </tr>

              <tr>
                <td>2</td>
                <td>Sayur Organik Mix</td>
                <td>Rp 25.000</td>
                <td>22</td>
                <td><a href="#" class="btn-delete">Hapus</a></td>
              </tr>

              <tr>
                <td>3</td>
                <td>Bawang Merah 1kg</td>
                <td>Rp 33.000</td>
                <td>16</td>
                <td><a href="#" class="btn-delete">Hapus</a></td>
              </tr>

            </tbody>
        </table>
    </div>
  </main>
</x-layoutAdmin>
