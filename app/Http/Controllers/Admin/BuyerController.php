<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = User::where('role', 'buyer')->with('orders.items.product')->get();

        return view('admin.dabu', compact('buyers'));
    }

    public function riwayat($id)
    {
        $orders = \App\Models\OrderItem::with('product', 'order')
            ->whereHas('order', function ($q) use ($id) {
                $q->where('user_id', $id);
            })
            ->get();

        $result = $orders->map(function ($item) {
            return [
                'tanggal' => $item->order->created_at->format('d M Y'),
                'produk'  => $item->product->name,
                'jumlah'  => $item->quantity,
                'total'   => number_format($item->total, 0, ',', '.'),
            ];
        });

        return response()->json($result);
    }
}
