<x-layoutAdmin title="Pesanan Admin">
  <!-- CONTENT -->
  <main class="main">
    <h2>Daftar Pesanan</h2>

    <div class="table-wrapper">
      <table class="pesanan-table">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pesanan</th>
            <th>Buyer</th>
            <th>Produk</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>#ORD001</td>
            <td>Budi Santoso</td>
            <td>Beras Premium (2)</td>
            <td>Rp 120.000</td>
            <td><span class="status menunggu">Menunggu Pembayaran</span></td>
            <td>12 Jan 2025</td>
            </td>
          </tr>

          <tr>
            <td>2</td>
            <td>#ORD002</td>
            <td>Ayu Lestari</td>
            <td>Sayur Organik (5)</td>
            <td>Rp 75.000</td>
            <td><span class="status diproses">Diproses</span></td>
            <td>15 Jan 2025</td>
            </td>
          </tr>

          <tr>
            <td>3</td>
            <td>#ORD003</td>
            <td>Rudi Hartono</td>
            <td>Telur Ayam (3)</td>
            <td>Rp 42.000</td>
            <td><span class="status dikirim">Dikirim</span></td>
            <td>18 Jan 2025</td>
            </td>
          </tr>

          <tr>
            <td>4</td>
            <td>#ORD004</td>
            <td>Rina Putri</td>
            <td>Cabai Merah (1)</td>
            <td>Rp 35.000</td>
            <td><span class="status selesai">Selesai</span></td>
            <td>20 Jan 2025</td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>
</x-layoutAdmin>
