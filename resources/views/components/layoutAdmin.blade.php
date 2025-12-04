<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard'}}</title>
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dabu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/riwayat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dataseller.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sellerdetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/pesanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/keuangan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/laporan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/pengaturan.css') }}">

</head>
<body>
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">

        <div class="brand">
            <div class="logo">A</div>
            <div>
                <h1>Admin Panel</h1>
                <span class="muted">Agro Mart</span>
            </div>
        </div>

    <ul class="nav-list">
      <li><a href="{{ route('admin.dashboard')}}" class="nav-link"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="{{ route('admin.buyer')}}" class="nav-link"><span class="icon">🧑‍🤝‍🧑</span> Data Buyer</a></li>
      <li><a href="{{ route('admin.dataseller')}}" class="nav-link"><span class="icon">🏬</span> Data Seller</a></li>
      <li><a href="{{ route('admin.keuangan')}}" class="nav-link"><span class="icon">💰</span> Keuangan</a></li>
      <li><a href="{{ route('admin.laporan')}}" class="nav-link"><span class="icon">📑</span> Laporan</a></li>
      <li><a href="{{ route('admin.orders')}}" class="nav-link"><span class="icon">📑</span> Order</a></li>
      <li><a href="{{ route('admin.pengaturan')}}" class="nav-link"><span class="icon">⚙️</span> Pengaturan</a></li>
    </ul>
  </aside>

  {{ $slot }}

</body>
</html>
