@php
    // $layoutComponent di-compact dari controller
    // contoh: 'layoutAdmin', 'layoutSeller', 'layoutBuyer'
    $componentName = $layoutComponent ?? 'layoutBuyer';
@endphp

<x-dynamic-component :component="$componentName" :title="'Notifikasi'">

    <div class="max-w-3xl mx-auto p-4">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">🔔 Semua Notifikasi</h2>

            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf
                <button class="text-sm text-blue-600 underline">Tandai semua dibaca</button>
            </form>
        </div>

        @if ($notifications->isEmpty())
            <div class="text-gray-500 text-center mt-10">
                Tidak ada notifikasi.
            </div>
        @else
            <div class="space-y-3">
                @foreach ($notifications as $notif)
                    <div class="p-4 border rounded-lg {{ $notif->read_at ? 'bg-gray-100' : 'bg-yellow-50' }}">

                        <div class="font-semibold">
                            {{ $notif->data['title'] ?? 'Notifikasi' }}
                        </div>

                        <div class="text-sm text-gray-700 mt-1">
                            {{ $notif->data['message'] ?? '-' }}
                        </div>

                        <div class="text-xs text-gray-500 mt-2">
                            {{ $notif->created_at->diffForHumans() }}
                        </div>

                        @if (!$notif->read_at)
                            <form action="{{ route('notifications.read', $notif->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button class="text-xs text-green-600 underline">
                                    Tandai dibaca
                                </button>
                            </form>
                        @endif

                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            @php
                $role = auth()->user()->role;
            @endphp

            @if ($role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 underline">⬅ Kembali ke Dashboard
                    Admin</a>
            @elseif ($role === 'seller')
                <a href="{{ route('seller.dashboard') }}" class="text-blue-600 underline">⬅ Kembali ke Dashboard
                    Seller</a>
            @else
                <a href="{{ route('buyer.profile') }}" class="text-blue-600 underline">⬅ Kembali ke Profil</a>
            @endif
        </div>

    </div>

</x-dynamic-component>
