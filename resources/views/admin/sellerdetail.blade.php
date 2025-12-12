<x-layoutAdmin title="Detail Seller - {{ $user->store_name ?? $user->name }}">
    <main class="main">
        <h2>Detail Seller</h2>

        @if (session('success'))
            <div class="p-3 bg-green-50 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="seller-box">
            <h3>Informasi Seller</h3>

            <div class="info-row">
                <div class="info-item">
                    <label>Nama Toko:</label>
                    <p>{{ $user->store_name ?? '-' }}</p>
                </div>

                <div class="info-item">
                    <label>Email:</label>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="info-item">
                    <label>No HP:</label>
                    <p>{{ $user->phone ?? '-' }}</p>
                </div>

                <div class="info-item">
                    <label>Status Toko:</label>

                    <form method="POST" action="{{ route('admin.sellers.updateStatus', $user->id) }}"
                        class="status-form inline-flex items-center">
                        @csrf
                        <select name="store_status" class="p-2 border rounded mr-2">
                            <option value="active" {{ ($user->store_status ?? '') === 'active' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="inactive" {{ ($user->store_status ?? '') === 'inactive' ? 'selected' : '' }}>
                                Non-Aktif</option>
                        </select>

                        <button type="submit" class="btn-save-status">Simpan</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="product-box mt-6">
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
                    @forelse($products as $idx => $product)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <form action="{{ route('admin.sellers.productDestroy', [$user->id, $product->id]) }}"
                                    method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center">Belum ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-layoutAdmin>
