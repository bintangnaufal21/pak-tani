<x-layoutAdmin title="Data Seller Admin">
  <!-- PAGE CONTENT -->
  <main class="content">
      <h2>Data Seller</h2>

      <div class="table-wrapper">
        <table class="seller-table">

          <thead>
            <tr>
              <th>No</th>
              <th>Nama Seller</th>
              <th>Email</th>
              <th>No HP</th>
              <th>Status Toko</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Toko Maju Jaya</td>
              <td>maju@gmail.com</td>
              <td>081234567890</td>
              <td><span class="badge non">Non-Aktif</span></td>
              <td>
                <a href="{{ route('admin.sellerdetail')}}" class="btn-detail">Detail</a>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td>Toko Subur Makmur</td>
              <td>subur@gmail.com</td>
              <td>081298765432</td>
              <td><span class="badge akt">Aktif</span></td>
              <td>
                <a href="{{ route('admin.sellerdetail')}}" class="btn-detail">Detail</a>
              </td>
            </tr>

          </tbody>

        </table>
      </div>
  </main>
</x-layoutAdmin>
