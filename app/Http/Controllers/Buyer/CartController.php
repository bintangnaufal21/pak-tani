<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();

        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id'    => $user->id,
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('buyer.keranjang', compact('items', 'subtotal'));
    }

    // 🔺 UPDATE QTY (+ / -)
    public function update(Request $request, CartItem $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->load('product');

        $type = $request->input('type'); // "plus" atau "minus"
        $qty  = $item->quantity;

        if ($type === 'plus') {
            $qty++;
        } elseif ($type === 'minus') {
            $qty--;
        }

        if ($qty < 1) {
            $qty = 1;
        }

        if ($item->product && $qty > $item->product->stock) {
            $qty = $item->product->stock;
        }

        $item->update(['quantity' => $qty]);

        return back();
    }

    public function delete(CartItem $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
