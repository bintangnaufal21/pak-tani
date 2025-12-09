<x-layoutSeller title="Riwayat Penjualan">

    <div class="bg-white p-6 rounded-2xl shadow-sm border overflow-x-auto">

        <h2 class="text-xl font-semibold mb-4 text-gray-800">Riwayat Penjualan</h2>

        @if ($orders->isEmpty())
            <p class="text-gray-500 text-sm">Belum ada riwayat penjualan.</p>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-gray-600">
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Pembeli</th>
                        <th class="py-3">Pendapatan Toko</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">
                                {{ $order->date->format('d M Y H:i') }}
                            </td>

                            <td class="py-3">
                                {{ $order->buyer }}
                            </td>

                            <td class="py-3">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>

                            <td class="py-3">
                                @php
                                    $cls = match ($order->status) {
                                        'completed' => 'bg-green-100 text-green-700',
                                        'shipped' => 'bg-blue-100 text-blue-700',
                                        'paid' => 'bg-yellow-100 text-yellow-700',
                                        'pending' => 'bg-gray-100 text-gray-600',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $cls }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</x-layoutSeller>
