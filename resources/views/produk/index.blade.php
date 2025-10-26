@extends('layouts.app')
@section('title', 'Manajemen Produk')
@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Daftar Produk</h2>

        <a href="/produk/tambah"
           class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200">
            + Tambah Produk
        </a>
    </div>


    <div class="bg-white shadow-md rounded-lg overflow-hidden">

        <table class="w-full table-auto divide-y divide-gray-200">


            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Petani (Seller)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stok
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Harga
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>


            <tbody class="bg-white divide-y divide-gray-200">

                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Beras Pandan Wangi</div>
                        <div class="text-sm text-gray-500">Organik</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Budi Santoso
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            50 Kg
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        Rp 75.000 / 5Kg
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Cabai Rawit Merah</div>
                        <div class="text-sm text-gray-500">Pedas</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Siti Aminah
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            5 Kg
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        Rp 40.000 / Kg
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                    </td>
                </tr>
                {{--
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data produk.
                    </td>
                </tr>
                --}}

            </tbody>
        </table>

        
        <div class="bg-white px-4 py-3 border-t border-gray-200">
            {{-- Tempat untuk link pagination nanti --}}
        </div>

    </div>

@endsection
