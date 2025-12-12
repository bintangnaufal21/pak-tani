<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{
    public function index()
    {
        // ambil order terbaru (ringkasan)
        $incomingOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(10)
            ->get();

        // hitung total per seller (hanya order yang sudah dibayar / completed)
        $sellerTotals = OrderItem::selectRaw('products.user_id as seller_id, SUM(order_items.total) as total')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.payment_status', ['paid', 'completed'])
            ->groupBy('products.user_id')
            ->pluck('total', 'seller_id'); // collection [seller_id => total]

        // ambil semua seller (atau filter hanya yg total>0 jika mau)
        $sellers = User::where('role', 'seller')->orderBy('name')->get();

        $adminFeePercent = config('finance.admin_fee_percent', 5); // default 5%

        // bangun rows untuk view, sertakan flag apakah sudah ada payout pending/sent
        $sellerRows = $sellers->map(function ($s) use ($sellerTotals, $adminFeePercent) {
            $total = (float) ($sellerTotals->get($s->id) ?? 0);

            $adminFee = round($total * ($adminFeePercent / 100), 2);
            $afterFee = round($total - $adminFee, 2);

            // apakah sudah ada payout yang belum selesai / sudah dikirim? (prevent double-send)
            $hasActivePayout = Payout::where('seller_id', $s->id)
                ->whereIn('status', ['processing', 'sent'])
                ->exists();

            // ambil last proof & last payout (opsional)
            $lastPayout = Payout::where('seller_id', $s->id)->latest()->first();

            return (object) [
                'id' => $s->id,
                'name' => $s->store_name ?: $s->name,
                'bank_name' => $s->bank_name,
                'bank_account_number' => $s->bank_account_number,
                'total' => $total,
                'admin_fee' => $adminFee,
                'after_fee' => $afterFee,
                'hasActivePayout' => $hasActivePayout,
                'lastPayout' => $lastPayout,
            ];
        });

        // riwayat transaksi singkat
        $transactions = OrderItem::select('order_items.*')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.payment_status', ['paid', 'completed'])
            ->latest()
            ->limit(50)
            ->get();

        return view('admin.keuangan', compact('incomingOrders', 'sellerRows', 'transactions'));
    }

    /**
     * POST /admin/keuangan/payout/{seller}
     */
    public function payout(Request $request, $sellerId)
    {
        $seller = User::findOrFail($sellerId);

        // Pastikan tidak ada active payout untuk seller (double-send prevention)
        $exists = Payout::where('seller_id', $seller->id)
            ->whereIn('status', ['processing', 'sent'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Payout untuk seller ini sedang diproses atau sudah dikirim.');
        }

        // validasi
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $amount = (float) $request->input('amount');

        $adminFeePercent = config('finance.admin_fee_percent', 5);
        $adminFee = round($amount * ($adminFeePercent / 100), 2);
        $amountAfterFee = round($amount - $adminFee, 2);

        // simpan file bukti
        $proofPath = $request->file('proof')->store('payouts', 'public');

        // simpan payout
        $payout = Payout::create([
            'seller_id' => $seller->id,
            'admin_id' => Auth::id(),
            'amount' => $amount,
            'admin_fee' => $adminFee,
            'amount_after_fee' => $amountAfterFee,
            'status' => 'sent', // langsung 'sent' atau 'processing' sesuai alur Anda
            'proof' => $proofPath,
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Dana berhasil diteruskan ke seller. Bukti tersimpan.');
    }
}
