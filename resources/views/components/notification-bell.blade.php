{{-- resources/views/components/notification-bell.blade.php --}}
@props(['limit' => 6])

@php
    $user = auth()->user();
    $unreadCount = $user ? \App\Models\Notification::where('user_id', $user->id)->whereNull('read_at')->count() : 0;

    $recent = $user ? \App\Models\Notification::where('user_id', $user->id)->latest()->limit($limit)->get() : collect();
@endphp

<div class="notification-bell relative" x-data>
    {{-- Button --}}
    <button id="notif-btn" class="flex items-center gap-3 bg-white px-3 py-2 rounded-full shadow hover:bg-gray-50"
        aria-expanded="false" type="button">
        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h11z" />
        </svg>

        @if ($unreadCount > 0)
            <span id="notif-badge"
                class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-red-500 text-white">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    {{-- Dropdown --}}
    <div id="notif-dropdown"
        class="hidden absolute right-0 mt-2 w-80 bg-white border rounded-lg shadow-lg z-50 overflow-hidden">
        <div class="px-4 py-3 border-b flex items-center justify-between">
            <strong>Notifikasi</strong>
            <div class="flex items-center gap-2">
                <button id="mark-all-btn" class="text-xs text-blue-600 hover:underline">Tandai semua dibaca</button>
                <a href="{{ route('notifications.index') }}" class="text-xs text-gray-600 hover:underline">Lihat
                    semua</a>
            </div>
        </div>

        <div id="notif-list" class="max-h-64 overflow-auto">
            @if ($recent->isEmpty())
                <div class="p-4 text-sm text-gray-500">Belum ada notifikasi.</div>
            @else
                @foreach ($recent as $n)
                    <div class="notif-item p-3 border-b flex gap-3 items-start {{ is_null($n->read_at) ? 'bg-gray-50' : '' }}"
                        data-id="{{ $n->id }}">
                        <div class="flex-1">
                            <div class="text-sm font-semibold text-gray-800">{{ $n->title }}</div>
                            <div class="text-xs text-gray-600 mt-1">
                                {{ Str::limit($n->body ?? ($n->data['message'] ?? ''), 120) }}</div>
                            <div class="text-xs text-gray-400 mt-2">{{ $n->created_at->diffForHumans() }}</div>
                        </div>

                        @if (is_null($n->read_at))
                            <button class="mark-read-btn text-xs text-blue-600">Tandai</button>
                        @else
                            <span class="text-xs text-gray-400">Dibaca</span>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <div class="px-3 py-2 text-xs text-gray-500">
            <small>Menampilkan {{ $recent->count() }} notifikasi terbaru.</small>
        </div>
    </div>

    {{-- Minimal styling internal supaya langsung rapi --}}
    <style>
        .notification-bell button {
            outline: none;
        }

        .notif-item {
            min-height: 56px;
        }
    </style>

    {{-- JS: toggle + mark-read + mark-all --}}
    <script>
        (function() {
            const btn = document.getElementById('notif-btn');
            const dropdown = document.getElementById('notif-dropdown');
            const markAllBtn = document.getElementById('mark-all-btn');
            const notifList = document.getElementById('notif-list');
            const badge = document.getElementById('notif-badge');

            function toggleDropdown() {
                dropdown.classList.toggle('hidden');
            }

            btn && btn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
                // close others
                document.querySelectorAll('.notification-bell').forEach(b => {
                    if (b !== btn.closest('.notification-bell')) {
                        const d = b.querySelector('#notif-dropdown');
                        if (d) d.classList.add('hidden');
                    }
                });
            });

            // click outside -> close
            document.addEventListener('click', function() {
                dropdown && dropdown.classList.add('hidden');
            });

            // mark single read
            notifList && notifList.addEventListener('click', function(e) {
                const t = e.target;
                if (t.classList.contains('mark-read-btn')) {
                    const item = t.closest('.notif-item');
                    const id = item.dataset.id;
                    markAsRead(id, function(ok) {
                        if (ok) {
                            item.classList.remove('bg-gray-50');
                            t.textContent = 'Dibaca';
                            t.disabled = true;
                            // decrement badge
                            if (badge) {
                                let v = Number(badge.textContent || 0) - 1;
                                if (v <= 0) badge.remove();
                                else badge.textContent = v;
                            }
                        }
                    });
                }
            });

            // mark all
            markAllBtn && markAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fetch("{{ route('notifications.readAll') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: '{}'
                }).then(r => r.json()).then(data => {
                    // mark all UI as read
                    document.querySelectorAll('.notif-item').forEach(i => {
                        i.classList.remove('bg-gray-50');
                        const btn = i.querySelector('.mark-read-btn');
                        if (btn) {
                            btn.textContent = 'Dibaca';
                            btn.disabled = true;
                        }
                    });
                    if (badge) badge.remove();
                }).catch(() => {
                    /* ignore */ });
            });

            function markAsRead(id, cb) {
                fetch("{{ url('/notifications') }}/" + id + "/read", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: '{}'
                }).then(r => {
                    if (r.ok) return r.json();
                    throw new Error('fail');
                }).then(d => cb(true)).catch(() => cb(false));
            }
        })();
    </script>
</div>
