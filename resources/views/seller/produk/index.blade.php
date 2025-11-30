<x-layoutSeller title="Produk">

  <div class="flex justify-between items-center mb-4">
    <a href="{{ route('produk.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
    + Tambah Produk Baru
</a>

  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border overflow-x-auto">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b text-gray-600">
          <th class="py-3">Foto</th>
          <th class="py-3">Nama Produk</th>
          <th class="py-3">Harga</th>
          <th class="py-3">Stok</th>
          <th class="py-3">Status</th>
          <th class="py-3">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @for($i=1;$i<=6;$i++)
        <tr class="border-b">
          <td class="py-3"><img src="https://via.placeholder.com/60" class="w-16 h-16 rounded" alt=""></td>
          <td class="py-3">Produk {{ $i }}</td>
          <td class="py-3">Rp {{ rand(5000, 35000) }} / Kg</td>
          <td class="py-3">{{ rand(10, 500) }} Kg</td>
          <td class="py-3" class="text-green-600">Tersedia</td>
          <td class="py-3 space-x-2">
<a href="#" class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-green-600">Edit</a>
<button class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-600">Hapus</button>

          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>

</x-layoutSeller>
