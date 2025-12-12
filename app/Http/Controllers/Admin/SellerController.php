<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function index()
    {
        // hanya user role = seller
        $sellers = User::where('role', 'seller')->latest()->get();

        return view('admin.dataseller', compact('sellers'));
    }

    public function show(User $user)
    {
        // pastikan ini seller
        if ($user->role !== 'seller') {
            abort(404);
        }

        // load produk seller
        $products = $user->products()->get();

        // contoh riwayat ringkas (order items) — jika butuh, tambahkan relasi
        $orders = $user->orders()->latest()->take(10)->get(); // optional, jika ada relasi orders

        return view('admin.sellerdetail', compact('user', 'products', 'orders'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'store_status' => 'required|in:active,inactive'
        ]);

        // simpan status toko (asumsi ada kolom store_status di users)
        $user->update([
            'store_status' => $request->input('store_status')
        ]);

        return redirect()->route('admin.sellerdetail', $user->id)
            ->with('success', 'Status toko berhasil diperbarui.');
    }

    public function productDestroy(User $user, Product $product)
    {
        // pastikan product milik seller
        if ($product->user_id !== $user->id) {
            abort(403, 'Produk bukan milik seller ini.');
        }

        // hapus file jika ada
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
