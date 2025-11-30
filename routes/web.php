<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\OrderData;

// Halaman login
Route::get('/login', function() {return view('auth.login');})->name('login');

// Proses login (POST)
Route::post('/login', function(Request $request){return redirect()->route('buyer.buyer');});
Route::post('/register', function(Request $request){return redirect()->route('login')->with('Yeay', 'Registrasi kamu berhasil, ayo login');});

// Halaman register
Route::get('/register', function() {return view('auth.register');})->name('register');

// Halaman buyer
Route::get('/', function(){return view('buyer.buyer');})->name('buyer.buyer');
Route::get('/buyer/produk', function(){return view('buyer.produk');})->name('buyer.produk');
Route::get('/buyer/keranjang', function(){return view('buyer.keranjang');})->name('buyer.keranjang');
Route::get('/buyer/co', function(){return view('buyer.co');})->name('buyer.co');
Route::get('/buyer/pesanan', function(){return view('buyer.pesanan');})->name('buyer.pesanan');
Route::get('/buyer/profile', function(){return view('buyer.profile');})->name('buyer.profile');

//Halaman dp buyer
Route::get('/buyer/dp/wortel', function(){return view('dp.wortel');})->name('dp.wortel');
Route::get('/buyer/dp/timun', function(){return view('dp.timun');})->name('dp.timun');
Route::get('/buyer/dp/sawip', function(){return view('dp.sawip');})->name('dp.sawip');
Route::get('/buyer/dp/paprika', function(){return view('dp.paprika');})->name('dp.paprika');

//Halaman admin
Route::get('/admin', function(){return view('admin.dashboard');})->name('admin.dashboard');
Route::get('/admin/dabu', function(){return view('admin.dabu');})->name('admin.dabu');
Route::get('/admin/dataseller', function(){return view('admin.dataseller');})->name('admin.dataseller');
Route::get('admin/sellerdetail', function(){return view('admin.sellerdetail');})->name('admin.sellerdetail');
Route::get('/admin/produk', function(){return view('admin.produk');})->name('admin.produk');
Route::get('/admin/pesanan', function(){return view('admin.pesanan');})->name('admin.pesanan');
Route::get('/admin/keuangan', function(){return view('admin.keuangan');})->name('admin.keuangan');
Route::get('/admin/laporan', function(){return view('admin.laporan');})->name('admin.laporan');
Route::get('/admin/pengaturan', function(){return view('admin.pengaturan');})->name('admin.pengaturan');

// ===============================
// SELLER ROUTES (STATIC VIEW)
// ===============================

    // Dashboard Seller
    Route::get('/seller', function () {
        return view('seller.dashboard');
    })->name('dashboard');

    // Produk
    Route::get('/produk', function () {
        return view('seller.produk.index');
    })->name('produk.index');

    Route::get('/produk/create', function () {
        return view('seller.produk.create');
    })->name('produk.create');

    Route::get('/produk/edit', function () {
        return view('seller.produk.edit');
    })->name('produk.edit');

    // Pesanan Buyer
    Route::get('/orders', function () {
    $orders = OrderData::all();
    return view('seller.orders.index', compact('orders'));
    })->name('orders.index');

    // Detail pesanan
    Route::get('/orders/{id}', function ($id) {
        $order = OrderData::find($id);
        return view('seller.orders.show', compact('order'));
    })->name('orders.show');
    // Riwayat Penjualan
    Route::get('/history', function () {
        return view('seller.history');
    })->name('history');

    // Profil Seller
    Route::get('/profil', function () {
        return view('seller.profil');
    })->name('profil');
