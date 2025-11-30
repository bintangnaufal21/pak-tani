<x-layoutSeller title="Riwayat Penjualan">

  <div class="bg-white p-6 rounded-2xl shadow-sm border overflow-x-auto">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b text-gray-600">
          <th class="py-3">Tanggal</th>
          <th class="py-3">Pembeli</th>
          <th class="py-3">Total Pendapatan</th>
          <th class="py-3">Status</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @foreach(range(1,5) as $i)
        @php
          $statuses = ['Selesai','Batal'];
          $s = $statuses[array_rand($statuses)];

          $statusClass = match($s) {
            'Selesai' => 'bg-green-200 text-green-900',
            'Batal' => 'bg-red-100 text-red-800',
          };
        @endphp
        <tr class="border-b">
          <td class="py-3">{{ now()->subDays($i)->format('d M Y') }}</td>
          <td class="py-3">Pembeli {{ $i }}</td>
          <td class="py-3">Rp {{ rand(500000,1500000) }}</td>
          <td class="py-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">{{ $s }}</span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</x-layoutSeller>
