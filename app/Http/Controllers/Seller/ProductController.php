<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // LIST PRODUK SELLER
    public function index()
    {
        $products = Product::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('seller.produk.index', compact('products'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('seller.produk.create');
    }

    // SIMPAN PRODUK BARU
    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'stock'       => ['required', 'integer', 'min:0'],
            'price'       => ['required', 'numeric', 'min:0'],
            'unit'        => ['required', 'string', 'max:50'],
            'image'       => ['nullable', 'image', 'max:2048'], // max 2MB
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            // simpan ke storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'description' => $request->description,
            'stock'       => $request->stock,
            'price'       => $request->price,
            'unit'        => $request->unit,
            'image_path'  => $imagePath,
        ]);

        return redirect()
            ->route('seller.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit(Product $product)
    {
    
        $this->authorizeProduct($product);

        return view('seller.produk.edit', compact('product'));
    }

    // UPDATE PRODUK
    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'stock'       => ['required', 'integer', 'min:0'],
            'price'       => ['required', 'numeric', 'min:0'],
            'unit'        => ['required', 'string', 'max:50'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->only(['name', 'description', 'stock', 'price', 'unit']);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('seller.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // HAPUS PRODUK
    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()
            ->route('seller.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // PASTIKAN HANYA PEMILIK PRODUK YANG BISA EDIT/HAPUS
    protected function authorizeProduct(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengelola produk ini.');
        }
    }
}
