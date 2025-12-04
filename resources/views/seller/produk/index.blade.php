<x-layoutSeller title="Produk Saya">

  <div class="flex justify-between items-center mb-4">
      <a href="{{ route('seller.produk.create') }}"
         class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
          + Tambah Produk Baru
      </a>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border overflow-x-auto">

      @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded-lg">
            {{ session('success') }}
        </div>
      @endif

      @if($products->count() == 0)
          <p class="text-center text-gray-500 py-6">
            Belum ada produk. Tambahkan produk pertama kamu ✨
          </p>
      @else
      <table class="w-full text-left">
          <thead>
              <tr class="border-b text-gray-600">
                  <th class="py-3">Foto</th>
                  <th class="py-3">Nama Produk</th>
                  <th class="py-3">Harga</th>
                  <th class="py-3">Stok</th>
                  <th class="py-3">Aksi</th>
              </tr>
          </thead>

          <tbody class="text-gray-700">

              @foreach($products as $product)
              <tr class="border-b">

                  <td class="py-3">
                      @if($product->image_path)
                          <img src="{{ asset('storage/'.$product->image_path) }}"
                               class="w-16 h-16 rounded object-cover">
                      @else
                          <img src="https://via.placeholder.com/60" class="w-16 h-16 rounded">
                      @endif
                  </td>

                  <td class="py-3 font-semibold">{{ $product->name }}</td>
                  <td class="py-3 text-green-700 font-medium">Rp {{ number_format($product->price,0,',','.') }}/{{ $product->unit }}</td>
                  <td class="py-3">{{ $product->stock }} {{ $product->unit }}</td>

                  <td class="py-3 flex gap-2">

                      {{-- EDIT --}}
                      <a href="{{ route('seller.produk.edit', $product->id) }}"
                         class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-green-600">
                         Edit
                      </a>

                      {{-- HAPUS --}}
                      <form action="{{ route('seller.produk.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                          @csrf
                          @method('DELETE')

                          <button type="submit"
                                  class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-600">
                              Hapus
                          </button>
                      </form>

                  </td>
              </tr>
              @endforeach

          </tbody>
      </table>
      @endif

  </div>

</x-layoutSeller>
