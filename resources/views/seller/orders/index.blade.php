<x-layoutSeller title="Pesanan">

  <div class="bg-white p-6 rounded-2xl shadow-sm border overflow-x-auto">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b text-gray-600">
          <th class="py-3">Nama Pembeli</th>
          <th class="py-3">Jumlah Pesanan</th>
          <th class="py-3">Total Harga</th>
          <th class="py-3">Status</th>
          <th class="py-3">Aksi</th>
        </tr>
      </thead>
     <tbody class="text-gray-700">
@foreach($orders as $order)
    @php
      $statusClass = match($order['status']) {
        'Menunggu' => 'bg-yellow-100 text-yellow-800',
        'Diproses' => 'bg-blue-100 text-blue-800',
        'Dikirim' => 'bg-green-100 text-green-800',
      };
    @endphp

    <tr class="border-b">
      <td class="py-3">{{ $order['buyer'] }}</td>
      <td class="py-3">{{ $order['qty'] }} Kg</td>
      <td class="py-3">Rp {{ number_format($order['total'],0,',','.') }}</td>
      <td class="py-3">
        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
          {{ $order['status'] }}
        </span>
      </td>
      <td class="py-3 space-x-2">
        <a href="{{ route('orders.show',$order['id']) }}"
           class="bg-green-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-green-700">
           Konfirmasi
        </a>

        <a href="{{ route('orders.show',$order['id']) }}"
           class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-700">
           Tolak
        </a>
      </td>
    </tr>
@endforeach
</tbody>
    </table>
  </div>

</x-layoutSeller>
