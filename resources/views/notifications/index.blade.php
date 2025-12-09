@php
    // $layoutComponent di-compact dari controller
    // contoh: 'layoutAdmin', 'layoutSeller', 'layoutBuyer'
    $componentName = $layoutComponent ?? 'layoutBuyer';
@endphp

<x-dynamic-component :component="$componentName" :title="'Notifikasi'">



    {{-- isi notifikasi ditempatkan dalam slot layout component --}}
    <div class="max-w-5xl mx-auto p-6">
         @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Notifikasi</h1>

            <div class="flex items-center gap-3">
                <form method="POST" action="{{ route('notifications.readAll') }}">
                    @csrf
                    <button type="submit" class="px-3 py-1 border rounded text-sm">Tandai semua dibaca</button>
                </form>

                <a href="{{ $backRoute }}" class="px-3 py-1 bg-green-600 text-white rounded text-sm">Kembali</a>
            </div>
        </div>

        <div class="bg-white rounded shadow-sm p-4">
            @if ($notifications->isEmpty())
                <p class="text-gray-600">Belum ada notifikasi.</p>
            @else
                <ul class="space-y-3">
                    @foreach ($notifications as $n)
                        <li
                            class="p-3 rounded border {{ is_null($n->read_at) ? 'bg-slate-50 border-slate-200' : 'bg-white' }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-semibold">{{ $n->title ?? 'Notifikasi' }}</div>
                                    <div class="text-sm text-gray-600 mt-1">{{ $n->body }}</div>
                                    <div class="text-xs text-gray-400 mt-2">{{ $n->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>

                                <div class="flex flex-col items-end gap-2">
                                    @if (is_null($n->read_at))
                                        <form method="POST" action="{{ route('notifications.read', $n->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="px-2 py-1 bg-indigo-600 text-white rounded text-xs">Tandai</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400">Dibaca</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

</x-dynamic-component>
