@props(['seller'])

<div class="bg-white rounded-lg shadow-sm p-4 flex gap-4 items-center">

    {{-- Avatar toko --}}
    <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100">
        <img
            src="{{ asset($seller['avatar'] ?? $seller->avatar ?? 'images/store.png') }}"
            alt="avatar"
            class="w-full h-full object-cover"
        >
    </div>

    {{-- Informasi seller --}}
    <div class="flex-1">
        <h3 class="text-lg font-semibold">
            {{ $seller['name'] ?? $seller->name ?? 'Nama Toko' }}
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            {{ $seller['bio'] ?? $seller->bio ?? 'Deskripsi toko belum diisi.' }}
        </p>

        <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-2 text-sm text-gray-700">

            <div>
                <span class="text-gray-400 block">Pemilik</span>
                <span>{{ $seller['owner'] ?? $seller->owner ?? '-' }}</span>
            </div>

            <div>
                <span class="text-gray-400 block">Telepon</span>
                <span>{{ $seller['phone'] ?? $seller->phone ?? '-' }}</span>
            </div>

            <div>
                <span class="text-gray-400 block">Alamat</span>
                <span>{{ $seller['address'] ?? $seller->address ?? '-' }}</span>
            </div>

        </div>
    </div>
</div>
