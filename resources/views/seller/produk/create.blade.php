<x-layoutSeller title="Tambah Produk">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Produk</h1>
        <a href="{{ route('seller.produk.index') }}"
            class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition text-gray-700">
            Kembali
        </a>
    </div>

    {{-- FORM TAMBAH PRODUK --}}
    <form action="{{ route('seller.produk.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-2xl shadow-md max-w-2xl space-y-6">
        @csrf

        {{-- Nama & Harga --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Timun Hijau"
                    required
                    class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="15000" required
                    min="100"
                    class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
        </div>

        {{-- Stok & Satuan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}" placeholder="10" required
                    min="1"
                    class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div class="flex flex-col">
                <label class="font-semibold text-gray-700 mb-1">Satuan (Kg/Ikat/Lusin)</label>
                <input type="text" name="unit" value="{{ old('unit', 'Kg') }}" required
                    class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Ceritakan kualitas produkmu 🥒"
                class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">{{ old('description') }}</textarea>
        </div>

        {{-- Gambar + PREVIEW --}}
        <div class="flex flex-col md:flex-row items-start gap-4">
            <div>
                <label class="font-semibold text-gray-700 mb-1">Gambar Produk</label>
                <input id="image-input" type="file" name="image" accept="image/*"
                    class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
            </div>

            <div>
                <p class="text-gray-600 text-sm mb-1">Preview gambar</p>
                <div class="w-40 h-32 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                    {{-- teks placeholder --}}
                    <span id="preview-text" class="text-gray-400 text-sm">Belum ada gambar</span>

                    {{-- gambar preview (disembunyikan dulu) --}}
                    <img id="image-preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-4 mt-4">
            <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                ✔ Simpan Produk
            </button>

            <a href="{{ route('seller.produk.index') }}"
                class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                Batal
            </a>
        </div>

    </form>

    {{-- SCRIPT PREVIEW GAMBAR --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('image-input');
            const img = document.getElementById('image-preview');
            const text = document.getElementById('preview-text');

            if (!input) return;

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (!file) {
                    // kalau user batal pilih gambar
                    img.src = '';
                    img.classList.add('hidden');
                    text.classList.remove('hidden');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    img.src = event.target.result;
                    img.classList.remove('hidden');
                    text.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

</x-layoutSeller>
