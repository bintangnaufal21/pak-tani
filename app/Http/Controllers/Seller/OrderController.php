<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        $orders = Order::with(['items.product', 'user'])
            ->whereHas('items.product', function ($q) use ($sellerId) {
                $q->where('user_id', $sellerId);
            })
            ->latest()
            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $sellerId = Auth::id();

        $order->load(['items.product', 'user']);

        $hasSellerProduct = $order->items
            ->contains(fn($item) => optional($item->product)->user_id == $sellerId);

        if (! $hasSellerProduct) {
            abort(403);
        }

        $sellerItems = $order->items->filter(
            fn($item) => optional($item->product)->user_id == $sellerId
        );

        $sellerTotal = $sellerItems->sum('total');

        return view('seller.orders.show', [
            'order'       => $order,
            'items'       => $sellerItems,
            'sellerTotal' => $sellerTotal,
        ]);
    }

    public function confirmShipping(Order $order)
    {
        $sellerId = Auth::id();

        // Pastikan order dimiliki seller (ada product milik seller di order)
        $order->load('items.product');

        $hasSellerProduct = $order->items
            ->contains(fn($item) => optional($item->product)->user_id == $sellerId);

        if (! $hasSellerProduct) {
            abort(403);
        }

        // Hanya boleh kirim ketika status order adalah 'paid'
        // (atau kalau Anda ingin, bisa pakai 'processing'/'paid' sesuai alur)
        if ($order->status !== 'paid') {
            return back()->with('error', 'Pesanan hanya bisa dikonfirmasi kirim jika statusnya sudah "paid". Saat ini status: ' . ($order->status ?? 'unknown'));
        }

        // Atomic update: ubah hanya jika status masih 'paid' (mencegah race / double-update)
        $updated = Order::where('id', $order->id)
            ->where('status', 'paid')   // <-- pastikan hanya dari 'paid' -> 'shipped'
            ->update([
                'status'     => 'shipped',
                'shipped_at' => now(),
            ]);

        if ($updated) {
            return back()->with('success', 'Status pesanan berhasil diubah menjadi DIKIRIM 🚚');
        }

        // kalau tidak ada perubahan (mis. sudah diupdate oleh aksi lain)
        return back()->with('info', 'Status pesanan tidak berubah — mungkin sudah diproses sebelumnya.');
    }
}
