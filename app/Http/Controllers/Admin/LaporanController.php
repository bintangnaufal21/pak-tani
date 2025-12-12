<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // LAPORAN TRANSAKSI (per item)
        $laporanTransaksi = OrderItem::with(['order.user', 'product'])
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.payment_status', ['paid', 'completed'])
            ->select('order_items.*')
            ->latest()
            ->get();

        // LAPORAN PENJUALAN PER SELLER
        $laporanPenjualan = User::where('role', 'seller')
            ->with(['products.orderItems.order' => function ($q) {
                $q->whereIn('payment_status', ['paid', 'completed']);
            }])
            ->get()
            ->map(function ($seller) {
                $totalPendapatan = 0;
                $produkTerjual = [];

                foreach ($seller->products as $product) {
                    $jumlahTerjual = $product->orderItems->count();
                    if ($jumlahTerjual > 0) {
                        $produkTerjual[] = $product->name . " (" . $jumlahTerjual . ")";
                        $totalPendapatan += $product->orderItems->sum('total');
                    }
                }

                return (object)[
                    'seller_name'      => $seller->name,
                    'produk_terjual'   => implode(', ', $produkTerjual) ?: '-',
                    'total_pendapatan' => $totalPendapatan,
                ];
            });

        return view('admin.laporan', compact('laporanTransaksi', 'laporanPenjualan'));
    }
}
