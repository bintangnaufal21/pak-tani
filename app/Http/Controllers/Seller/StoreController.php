<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    // Form "Buka Toko"
    public function create()
    {
        $user = User::find(Auth::id());

        // Kalau sudah seller, langsung ke dashboard seller saja
        if ($user->role === 'seller') {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Anda sudah memiliki toko.');
        }

        return view('seller.buka-toko');
    }

    // Proses "Buka Toko"
    public function store(Request $request)
    {
        $user = Auth::user();

        // Kalau sudah seller, abaikan
        if ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        // Validasi data toko (sementara simpel dulu)
        $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
        ]);

        // TODO: nanti bisa bikin tabel stores, sekarang kita ubah role dulu
        $user->role = 'seller';
        $user->save();

        return redirect()->route('seller.dashboard')
            ->with('success', 'Toko berhasil dibuat, Anda sekarang menjadi seller.');
    }
}
