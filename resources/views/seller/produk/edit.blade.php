<x-layoutSeller title="Edit Produk">
  @php
    $product = [
      'id'=>1,
      'name'=>'Timun Segar',
      'price'=>15000,
      'stock'=>12,
      'image'=>'images/timun.jpeg',
      'category'=>'Sayuran',
      'status'=>'Tersedia'
    ];
  @endphp

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Produk — {{ $product['name'] }}</h1>
    <a href="{{ route('produk.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition text-gray-700">Kembali</a>
  </div>

  <form class="bg-white p-6 rounded-2xl shadow-md max-w-2xl space-y-6">

    {{-- Nama & Harga --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Nama Produk</label>
        <input type="text" value="{{ $product['name'] }}" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Harga (Rp)</label>
        <input type="number" value="{{ $product['price'] }}" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>
    </div>

    {{-- Stok & Status --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Stok</label>
        <input type="number" value="{{ $product['stock'] }}" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Status</label>
        <select class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
          <option {{ $product['status']=='Tersedia' ? 'selected' : '' }}>Tersedia</option>
          <option {{ $product['status']=='Habis' ? 'selected' : '' }}>Habis</option>
        </select>
      </div>
    </div>

    {{-- Kategori --}}
    <div class="flex flex-col">
      <label class="font-semibold text-gray-700 mb-1">Kategori</label>
      <select class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
        <option {{ $product['category']=='Sayuran' ? 'selected' : '' }}>Sayuran</option>
        <option>Buah</option>
        <option>Padi & Jagung</option>
      </select>
    </div>

    {{-- Gambar --}}
    <div class="flex flex-col md:flex-row items-start gap-4">
      <div>
        <label class="font-semibold text-gray-700 mb-1">Gambar Saat Ini</label>
        <img src="{{ asset($product['image']) }}" class="w-40 h-32 object-cover rounded-lg border shadow-sm">
      </div>
      <div class="flex flex-col mt-2 md:mt-0">
        <label class="font-semibold text-gray-700 mb-1">Ganti Gambar (dummy)</label>
        <input type="file" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
      </div>
    </div>

    {{-- Tombol aksi --}}
    <div class="flex gap-4 mt-4">
      <button type="button" class="bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition">Update (Dummy)</button>
      <button type="button" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Batal</button>
    </div>

  </form>
</x-layoutSeller>
