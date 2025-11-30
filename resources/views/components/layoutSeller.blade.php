@props(['title' => 'Dashboard Seller'])

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white h-screen shadow-lg fixed">
    <div class="p-6 border-b">
      <h1 class="text-2xl font-bold text-green-700">Pak Tani</h1>
      <p class="text-xs text-gray-500 -mt-1">Penjualan Hasil Panen</p>
    </div>
    <nav class="p-4 space-y-2">
      <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('dashboard*') ? 'bg-green-100 font-bold' : '' }}">🌾 Dashboard</a>
      <a href="{{ route('produk.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('produk.*') ? 'bg-green-100 font-bold' : '' }}">📦 Produk</a>
      <a href="{{ route('orders.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('orders.*') ? 'bg-green-100 font-bold' : '' }}">🛒 Pesanan</a>
      <a href="{{ route('history') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('history*') ? 'bg-green-100 font-bold' : '' }}">📊 Riwayat Penjualan</a>
      <a href="{{ route('profil') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 {{ request()->routeIs('profil*') ? 'bg-green-100 font-bold' : '' }}">👤 Profil Seller</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="ml-64 flex-1 p-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-gray-800">{{ $title }}</h2>
      <img src="https://i.pravatar.cc/50" class="w-11 h-11 rounded-full border shadow" alt="Avatar">
    </div>

    {{ $slot }}
  </main>
</div>

</body>
</html>
