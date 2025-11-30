<x-layoutSeller title="Detail Pesanan">

  <div style="display:flex;justify-content:space-between;align-items:center">
    <h1>Detail Pesanan #{{ $order['id'] }}</h1>
    <a href="{{ route('orders.index') }}" class="btn outline">Kembali</a>
  </div>

  <div style="margin-top:12px;background:#fff;padding:14px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.03);max-width:800px">
    <p><strong>Pemesan:</strong> {{ $order['buyer'] }}</p>
    <p><strong>Status:</strong> {{ $order['status'] }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($order['total'],0,',','.') }}</p>

    <div style="margin-top:8px">
      <button class="btn">Konfirmasi Pengiriman</button>
      <button class="btn outline">Hubungi Pembeli</button>
    </div>
  </div>

</x-layoutSeller>
