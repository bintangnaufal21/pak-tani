<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\NotifyService;
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
        if ($order->payment_status !== 'paid' || $order->status !== 'paid') {
            return back()->with('error', 'Pesanan hanya bisa dikonfirmasi kirim jika statusnya sudah "paid". Saat ini status: ' . ($order->status ?? 'unknown'));
        }

        // Atomic update: ubah hanya jika status masih 'paid' (mencegah race / double-update)
        $updated = Order::where('id', $order->id)
            ->where('payment_status', 'paid')
            ->where('status', 'paid')
            ->update([
                'status'     => 'shipped',
                'shipped_at' => now(),
            ]);

        if ($updated) {
            // notify buyer that seller shipped
            NotifyService::notify($order->user_id, 'order.shipped', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'message' => 'Pesanan Anda ' . $order->order_code . ' sedang dikirim oleh penjual.',
            ]);

            // notify admin (optional) that seller shipped
            // NotifyService::notify($adminId, ...); // jika perlu

            return back()->with('success', 'Status pesanan berhasil diubah menjadi DIKIRIM 🚚');
        }

        return back()->with('info', 'Status pesanan tidak berubah — mungkin sudah diproses sebelumnya.');
    }

    public function history()
    {
        $sellerId = Auth::id();

        $orders = Order::with(['user', 'items.product'])
            ->whereHas('items.product', function ($q) use ($sellerId) {
                $q->where('user_id', $sellerId);
            })
            ->latest()
            ->get()
            ->map(function ($order) use ($sellerId) {
                // Hitung hanya total dari produk milik seller
                $sellerTotal = $order->items
                    ->filter(fn($i) => $i->product && $i->product->user_id == $sellerId)
                    ->sum('total');

                return (object) [
                    'date'   => $order->created_at,
                    'buyer'  => $order->receiver_name ?? $order->user->name,
                    'status' => $order->status,
                    'total'  => $sellerTotal,
                ];
            });

        return view('seller.history', compact('orders'));
    }

    public function dashboard()
    {
        $sellerId = Auth::id();

        // TOTAL PRODUK TERJUAL
        $TotalOrders = OrderItem::whereHas('product', function ($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })
            ->sum('quantity');

        // TOTAL PENDAPATAN
        $TotalEarn = OrderItem::whereHas('product', function ($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->sum('order_items.total');

        // TOTAL TRANSAKSI (jumlah pesanan yang mengandung produk seller)
        $TotalTransactions = Order::whereHas('items.product', function ($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })
            ->count();

        return view('seller.dashboard', [
            'Totalorders'       => $TotalOrders,
            'TotalEarn'         => number_format($TotalEarn, 0, ',', '.'),
            'TotalTransactions' => $TotalTransactions,
        ]);
    }
}
