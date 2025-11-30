@props(['order'])

<div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-start">

    {{-- Kiri: Info Customer & Item --}}
    <div class="flex-1">
        <div class="flex items-baseline gap-2">
            <div class="text-sm font-semibold">#{{ $order['id'] ?? $order->id }}</div>
            <div class="text-sm text-gray-600">{{ $order['customer'] ?? $order->customer_name ?? 'Pembeli' }}</div>
        </div>

        <div class="text-xs text-gray-400 mt-1">
            {{ $order['date'] ?? ($order->created_at ?? '') }}
        </div>

        <div class="mt-3 space-y-1">
            @foreach($order['items'] ?? ($order->items ?? []) as $item)
                <div class="text-sm text-gray-700">• {{ $item['name'] ?? $item->name }} x {{ $item['qty'] ?? $item->quantity ?? 1 }}</div>
            @endforeach
        </div>
    </div>


    {{-- Kanan: Total & Status --}}
    <div class="text-right w-40 ml-4">

        <div class="text-sm font-semibold">
            Rp {{ number_format($order['total'] ?? ($order->total ?? 0), 0, ',', '.') }}
        </div>

        <div
            class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white
            {{ ($order['status'] ?? ($order->status ?? '')) === 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}"
        >
            {{ ucfirst($order['status'] ?? ($order->status ?? '')) }}
        </div>

        <div class="mt-3 flex justify-end gap-2">
            <a href="#" class="text-xs px-2 py-1 rounded bg-green-600 text-white">Detail</a>
            <button class="text-xs px-2 py-1 rounded border border-gray-300">Konfirmasi</button>
        </div>

    </div>

</div>
