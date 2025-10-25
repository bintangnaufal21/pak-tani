{{-- Memberi tahu Laravel untuk menggunakan file layout di layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Ini akan mengisi @yield('title') di Navbar --}}
@section('title', 'Ringkasan Dashboard')

{{-- Ini akan mengisi @yield('content') di Konten Utama --}}
@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Petani</h3>
            <p class="text-3xl font-bold text-gray-900">12</p> </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Produk</h3>
            <p class="text-3xl font-bold text-gray-900">84</p> </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Pesanan Baru</h3>
            <p class="text-3xl font-bold text-green-500">5</p> </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Pendapatan Hari Ini</h3>
            <p class="text-3xl font-bold text-gray-900">Rp 1.200.000</p> </div>

    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Penjualan (Contoh)</h3>
        <div class="h-64 bg-gray-200 rounded flex items-center justify-center">
            <span class="text-gray-500">Tempat untuk Grafik</span>
        </div>
    </div>

@endsection
