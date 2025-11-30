<x-layoutSeller title="Tambah Produk">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Produk</h1>
    <a href="{{ route('produk.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition text-gray-700">Kembali</a>
  </div>

  <form class="bg-white p-6 rounded-2xl shadow-md max-w-2xl space-y-6">

    {{-- Nama & Harga --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Nama Produk</label>
        <input type="text" placeholder="Contoh: Timun" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Harga (Rp)</label>
        <input type="number" placeholder="15000" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>
    </div>

    {{-- Stok & Status --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Stok</label>
        <input type="number" placeholder="10" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Status</label>
        <select class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
          <option>Tersedia</option>
          <option>Habis</option>
        </select>
      </div>
    </div>

    {{-- Kategori --}}
    <div class="flex flex-col">
      <label class="font-semibold text-gray-700 mb-1">Kategori</label>
      <select class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
        <option>Sayuran</option>
        <option>Buah</option>
        <option>Padi & Jagung</option>
      </select>
    </div>

    {{-- Gambar --}}
    <div class="flex flex-col md:flex-row items-start gap-4">
      <div>
        <label class="font-semibold text-gray-700 mb-1">Gambar Produk</label>
        <input type="file" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>
      <div class="mt-2 md:mt-0">
        <label class="font-semibold text-gray-700 mb-1">Preview Gambar (dummy)</label>
        <div class="w-40 h-32 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Preview</div>
      </div>
    </div>

    {{-- Tombol aksi --}}
    <div class="flex gap-4 mt-4">
      <button type="button" class="bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition">Simpan (Dummy)</button>
      <button type="button" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Batal</button>
    </div>

  </form>
</x-layoutSeller>
