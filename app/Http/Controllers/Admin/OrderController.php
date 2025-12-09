<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\NotifyService;
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
        // only update if not already paid
        $updated = false;
        if ($order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'status'         => 'paid',
                'verified_at'    => now(),
            ]);
            $updated = true;
        }

        if ($updated) {
            // notify sellers
            $sellerIds = $order->items->map(fn($i) => optional($i->product)->user_id)
                ->filter()->unique()->values()->toArray();

            foreach ($sellerIds as $sid) {
                NotifyService::notify($sid, 'order.payment_approved', [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'message' => 'Pembayaran ' . $order->order_code . ' telah diverifikasi oleh admin.',
                ]);
            }

            // notify buyer
            NotifyService::notify($order->user_id, 'order.payment_approved.buyer', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'message' => 'Pembayaran pesanan ' . $order->order_code . ' telah disetujui oleh admin.',
            ]);

            return back()->with('success', 'Pembayaran berhasil diverifikasi ✔');
        }

        return back()->with('info', 'Pembayaran sudah dalam status PAID sebelumnya.');
    }

    public function rejectPayment(Order $order)
    {
        $order->update([
            'payment_status' => 'rejected',
            'status'         => 'cancelled',
        ]);

        // notify buyer
        NotifyService::notify($order->user_id, 'order.payment_rejected', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'message' => 'Pembayaran ' . $order->order_code . ' ditolak oleh admin.',
        ]);

        return back()->with('error', 'Pembayaran ditolak ❗');
    }
}
