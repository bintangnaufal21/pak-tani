<x-layoutSeller title="Dashboard">

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    {{-- TOTAL PRODUK TERJUAL --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border">
      <p class="text-sm text-gray-500">Jumlah Produk Dijual</p>
      <h3 class="text-3xl font-extrabold mt-1 text-green-700">{{ $Totalorders }}</h3>
    </div>

    {{-- TOTAL PENDAPATAN --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border">
      <p class="text-sm text-gray-500">Total Pendapatan</p>
      <h3 class="text-3xl font-extrabold mt-1 text-green-700">Rp {{ $TotalEarn }}</h3>
    </div>

    {{-- TOTAL TRANSAKSI --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border">
      <p class="text-sm text-gray-500">Jumlah Transaksi</p>
      <h3 class="text-3xl font-extrabold mt-1 text-green-700">{{ $TotalTransactions }}</h3>
    </div>

  </div>
</x-layoutSeller>
