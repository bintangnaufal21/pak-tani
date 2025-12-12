<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL PESANAN
        $totalOrders = Order::count();

        // TOTAL BUYER
        $totalBuyer = User::where('role', 'buyer')->count();

        // TOTAL SELLER
        $totalSeller = User::where('role', 'seller')->count();

        // TOTAL PENJUALAN (yang sudah dibayar)
        $totalSales = Order::where('payment_status', 'paid')->sum('total');

        // TOTAL TRANSAKSI
        $totalTransactions = Order::count();

        // PESANAN TERBARU (5 TERAKHIR)
        $latestOrders = Order::with(['user', 'items.product.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalBuyer',
            'totalSeller',
            'totalSales',
            'totalTransactions',
            'latestOrders'
        ));
    }
}
