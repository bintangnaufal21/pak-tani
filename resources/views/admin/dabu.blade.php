<x-layoutAdmin title="Data Buyer Admin">

    <main class="main">
        <h2>Data Buyer</h2>

        <div class="table-wrapper">
            <table class="buyer-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Buyer</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($buyers as $buyer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buyer->name }}</td>
                            <td>{{ $buyer->email }}</td>
                            <td>{{ $buyer->phone ?? '-' }}</td>
                            <td>
                                <button class="btn-riwayat"
                                    onclick="openRiwayat({{ $buyer->id }}, '{{ $buyer->name }}')">
                                    Riwayat
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center">Belum ada data buyer</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- MODAL RIWAYAT -->
    <div id="modal-riwayat" class="fixed inset-0 hidden z-50 bg-black/60 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6 relative">

            <button onclick="closeRiwayat()" class="absolute top-3 right-4 text-xl font-bold">×</button>

            <h3 class="text-lg font-bold mb-4" id="riwayat-title">Riwayat Pembelian</h3>

            <table class="w-full border">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Produk</th>
                        <th class="p-2">Jumlah</th>
                        <th class="p-2">Total</th>
                    </tr>
                </thead>
                <tbody id="riwayat-body"></tbody>
            </table>
        </div>
    </div>

    <script>
        function openRiwayat(userId, userName) {
            document.getElementById('modal-riwayat').classList.remove('hidden');
            document.getElementById('riwayat-title').innerText = 'Riwayat Pembelian: ' + userName;

            fetch('/admin/data/buyer/' + userId + '/riwayat')
                .then(res => res.json())
                .then(data => {
                    let html = '';

                    if (data.length === 0) {
                        html = `<tr><td colspan="4" class="p-4 text-center">Belum ada transaksi</td></tr>`;
                    } else {
                        data.forEach(item => {
                            html += `
                        <tr class="border-b">
                            <td class="p-2">${item.tanggal}</td>
                            <td class="p-2">${item.produk}</td>
                            <td class="p-2 text-center">${item.jumlah}</td>
                            <td class="p-2">Rp ${item.total}</td>
                        </tr>
                    `;
                        });
                    }

                    document.getElementById('riwayat-body').innerHTML = html;
                });
        }

        function closeRiwayat() {
            document.getElementById('modal-riwayat').classList.add('hidden');
        }
    </script>


</x-layoutAdmin>
