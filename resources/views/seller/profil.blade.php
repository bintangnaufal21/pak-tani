<x-layoutSeller title="Profil Seller">

    <div class="bg-white p-6 rounded-2xl shadow-sm border max-w-3xl">

        {{-- NOTIF SUKSES --}}
        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- HEADER TOKO --}}
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
            <div class="relative">
                @if ($user->store_logo)
                    <img src="{{ asset('storage/' . $user->store_logo) }}"
                        class="w-24 h-24 rounded-full border shadow object-cover" alt="Logo Toko">
                @else
                    <div
                        class="w-24 h-24 rounded-full border shadow flex items-center justify-center bg-green-50 text-green-700 text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $user->store_name ?? 'Toko ' . $user->name }}
                </h2>
                <p class="text-gray-500">Pemilik: {{ $user->name }}</p>
                <p class="text-gray-500">Email: {{ $user->email }}</p>
                @if ($user->phone)
                    <p class="text-gray-500">HP / WA: {{ $user->phone }}</p>
                @endif
            </div>
        </div>

        {{-- FORM EDIT PROFIL SELLER --}}
        <form action="{{ route('seller.profil.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- INFO TOKO --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Toko</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                        <input type="text" name="store_name"
                            value="{{ old('store_name', $user->store_name ?? 'Toko ' . $user->name) }}"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Toko</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Toko</label>
                        <textarea name="store_description" rows="3"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none"
                            placeholder="Ceritakan tentang hasil panen, kualitas, dan layananmu...">{{ old('store_description', $user->store_description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- LOGO TOKO --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Logo Toko</h3>
                <div class="flex flex-col md:flex-row gap-4 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Logo Baru</label>
                        <input type="file" name="logo" accept="image/*"
                            class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                        <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti logo.</p>
                    </div>

                    @if ($user->store_logo)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Logo Saat Ini:</p>
                            <img src="{{ asset('storage/' . $user->store_logo) }}"
                                class="w-24 h-24 rounded-full object-cover border shadow">
                        </div>
                    @endif
                </div>
            </div>

            {{-- REKENING PEMBAYARAN --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Rekening Pembayaran</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $user->bank_name) }}"
                            placeholder="BCA / BRI / Mandiri"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Rekening</label>
                        <input type="text" name="bank_account_number"
                            value="{{ old('bank_account_number', $user->bank_account_number) }}"
                            placeholder="1234567890"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                        <input type="text" name="bank_account_holder"
                            value="{{ old('bank_account_holder', $user->bank_account_holder ?? $user->name) }}"
                            placeholder="Nama di buku tabungan"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                </div>

                <p class="text-xs text-gray-400 mt-2">
                    Rekening ini digunakan admin untuk mengirim hasil penjualan pesananmu.
                </p>
            </div>

            {{-- TOMBOL SIMPAN --}}
            <div class="pt-2">
                <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>

</x-layoutSeller>
