<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductViewController extends Controller
{
    // Beranda: bisa pakai sebagian produk
    public function home()
    {
        $products = Product::latest()->paginate(12);
        return view('buyer.buyer', compact('products'));
    }

    // Halaman semua produk
    public function index()
    {
        $products = Product::latest()->paginate(12);
        return view('buyer.produk', compact('products'));
    }

    // Halaman detail produk
    public function show(Product $product)
    {
        return view('buyer.detail', compact('product'));
    }
}
