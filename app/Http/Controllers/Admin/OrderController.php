<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.order-detail', compact('order'));
    }

    public function verifyPayment(Order $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status'         => 'paid',
            'verified_at'    => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi ✔');
    }

    public function rejectPayment(Order $order)
    {
        $order->update([
            'payment_status' => 'rejected',
            'status'         => 'cancelled',
        ]);

        return back()->with('error', 'Pembayaran ditolak ❗');
    }
}
