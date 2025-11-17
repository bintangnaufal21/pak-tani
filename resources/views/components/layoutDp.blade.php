<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Buyer DP'}}</title>
  <link rel="stylesheet" href="{{ asset('css/buyer/produk.css')}}">
  <link rel="stylesheet" href="{{ asset('css/buyer/bottom.css')}}">
  <link rel="stylesheet" href="{{ asset('css/buyer/dp.css')}}">
</head>
<body>

    {{ $slot }}

  <!-- BOTTOM NAVBAR -->
  <nav class="bottom-nav">
    <a href="{{ route('buyer.buyer') }}" class="active">🏠<span>Beranda</span></a>
    <a href="{{ route('buyer.produk')}}">🛍️<span>Produk</span></a>
    <a href="{{ route('buyer.keranjang')}}">🛒<span>Keranjang</span></a>
    <a href="{{ route('buyer.pesanan')}}">📦<span>Pesanan</span></a>
    <a href="{{ route('buyer.profile')}}">👤<span>Profil</span></a>
  </nav>

</body>
</html>

