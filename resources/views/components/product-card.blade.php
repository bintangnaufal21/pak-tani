@props(['product'])

<div class="bg-white rounded-lg shadow-sm p-3 w-56">

    {{-- Gambar Produk --}}
    <div class="h-36 bg-gray-100 rounded-md overflow-hidden">
        <img
            src="{{ asset($product['image'] ?? $product->image ?? 'images/default-product.png') }}"
            alt="{{ $product['name'] ?? $product->name }}"
            class="w-full h-full object-cover"
        >
    </div>

    {{-- Info Produk --}}
    <div class="mt-3">
        <h4 class="text-sm font-semibold text-gray-900 truncate">
            {{ $product['name'] ?? $product->name }}
        </h4>

        @if(isset($product['stock']) || isset($product->stock))
        <div class="text-xs text-gray-500">
            Stok: {{ $product['stock'] ?? $product->stock }}
        </div>
        @endif

        <div class="mt-2 flex items-center justify-between">
            <div class="text-sm font-medium text-green-700">
                Rp {{ number_format($product['price'] ?? $product->price ?? 0, 0, ',', '.') }}
            </div>

            <div class="flex items-center gap-2">
                <a href="#" class="text-xs px-2 py-1 rounded bg-green-600 text-white">Edit</a>
                <button class="text-xs px-2 py-1 rounded bg-red-500 text-white">Hapus</button>
            </div>
        </div>
    </div>
</div>
