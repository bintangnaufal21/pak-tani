<x-layoutAdmin title="Data Seller Admin">
    <main class="main">
        <h2>Data Seller</h2>

        @if (session('success'))
            <div class="p-3 bg-green-50 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif

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
                    @foreach ($sellers as $i => $seller)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $seller->store_name ?? $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->phone ?? '-' }}</td>
                            <td>
                                <span
                                    class="badge {{ ($seller->store_status ?? 'inactive') === 'active' ? 'akt' : 'non' }}">
                                    {{ ($seller->store_status ?? 'inactive') === 'active' ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.sellerdetail', $seller->id) }}" class="btn-detail">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-layoutAdmin>
