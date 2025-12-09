<?php

use App\Http\Controllers\Admin\BuyerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Buyer\ProductViewController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProfileController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\NotificationController;



Route::get('/', [GuestController::class, 'index'])->name('guest');
/* Auth */
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
});

/* Buyer */
Route::prefix('buyer')->name('buyer.')->middleware(['auth'])->group(function () {
    Route::get('/', [ProductViewController::class, 'home'])->name('home');
    Route::get('/produk', [ProductViewController::class, 'index'])->name('produk');
    Route::get('/produk/{product}', [ProductViewController::class, 'show'])->name('produk.detail');

    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/{product}', [CartController::class, 'add'])->name('keranjang.add');
    Route::patch('/keranjang/{item}', [CartController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{item}', [CartController::class, 'delete'])->name('keranjang.delete');

    Route::get('/checkout', [BuyerOrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [BuyerOrderController::class, 'placeOrder'])->name('checkout.place');

    Route::get('/pesanan', [BuyerOrderController::class, 'index'])->name('pesanan');
    Route::post('/pesanan/{order}/complete', [BuyerOrderController::class, 'confirmReceived'])->name('orders.complete');

    Route::get('/profile', fn() => view('buyer.profile'))->name('profile');

    Route::get('/buka-toko', [StoreController::class, 'create'])->name('buka-toko');
    Route::post('/buka-toko', [StoreController::class, 'store'])->name('buka-toko.store');
});

/* Admin */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/verifikasi', [AdminOrderController::class, 'verifyPayment'])->name('orders.verify');
    Route::post('/orders/{order}/tolak', [AdminOrderController::class, 'rejectPayment'])->name('orders.reject');

    Route::get('/data/buyer', [BuyerController::class, 'index'])->name('buyer');
    Route::get('/data/seller', [SellerController::class, 'index'])->name('dataseller');
    Route::get('/data/seller/detail', [SellerController::class, 'show'])->name('sellerdetail');
    Route::get('/data/keungan', [DashboardController::class, 'keuangan'])->name('keuangan');
    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan');
    Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
});

/* Seller */
Route::prefix('seller')->name('seller.')->middleware(['auth', 'role:seller,admin'])->group(function () {

    Route::get('/', [SellerOrderController::class, 'dashboard'])->name('dashboard');

    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/kirim', [SellerOrderController::class, 'confirmShipping'])->name('orders.ship');

    // product CRUD & profile...
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{product}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('produk.destroy');

    // Profile
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

    //History
    Route::get('/riwayat', [SellerOrderController::class, 'history'])->name('history');
});
