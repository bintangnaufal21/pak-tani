<x-layoutSeller title="Edit Produk">

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
      Edit Produk — {{ $product->name }}
    </h1>
    <a href="{{ route('seller.produk.index') }}"
       class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition text-gray-700">
      Kembali
    </a>
  </div>

  {{-- TAMPILKAN ERROR JIKA ADA --}}
  @if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg text-sm">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- FORM EDIT PRODUK --}}
  <form action="{{ route('seller.produk.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white p-6 rounded-2xl shadow-md max-w-2xl space-y-6">
    @csrf
    @method('PUT')

    {{-- Nama & Harga --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Nama Produk</label>
        <input type="text"
               name="name"
               value="{{ old('name', $product->name) }}"
               placeholder="Contoh: Timun Segar"
               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
               required>
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Harga (Rp)</label>
        <input type="number"
               name="price"
               value="{{ old('price', $product->price) }}"
               min="0"
               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
               required>
      </div>
    </div>

    {{-- Stok & Satuan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Stok</label>
        <input type="number"
               name="stock"
               value="{{ old('stock', $product->stock) }}"
               min="0"
               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
               required>
      </div>

      <div class="flex flex-col">
        <label class="font-semibold text-gray-700 mb-1">Satuan (Kg/Ikat/Lusin)</label>
        <input type="text"
               name="unit"
               value="{{ old('unit', $product->unit) }}"
               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
               required>
      </div>
    </div>

    {{-- Deskripsi --}}
    <div class="flex flex-col">
      <label class="font-semibold text-gray-700 mb-1">Deskripsi</label>
      <textarea name="description"
                rows="3"
                class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
                placeholder="Ceritakan kualitas produkmu…">{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- Gambar --}}
    <div class="flex flex-col md:flex-row items-start gap-4">
      <div>
        <label class="font-semibold text-gray-700 mb-1">Gambar Saat Ini</label>
        @if($product->image_path)
          <img src="{{ asset('storage/'.$product->image_path) }}"
               class="w-40 h-32 object-cover rounded-lg border shadow-sm">
        @else
          <div class="w-40 h-32 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
            Belum ada gambar
          </div>
        @endif
      </div>

      <div class="flex flex-col mt-2 md:mt-0">
        <label class="font-semibold text-gray-700 mb-1">Ganti Gambar</label>
        <input type="file"
               name="image"
               accept="image/*"
               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
        <span class="text-xs text-gray-500 mt-1">
          Biarkan kosong jika tidak ingin mengganti gambar.
        </span>
      </div>
    </div>

    {{-- Tombol aksi --}}
    <div class="flex gap-4 mt-4">
      <button type="submit"
              class="bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
        Update Produk
      </button>

      <a href="{{ route('seller.produk.index') }}"
         class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
        Batal
      </a>
    </div>

  </form>
</x-layoutSeller>
