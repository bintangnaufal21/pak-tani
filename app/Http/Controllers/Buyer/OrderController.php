<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * TAMPIL HALAMAN CHECKOUT
     */
    public function checkout()
    {
        $user  = Auth::user();

        $items = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('buyer.keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // default ongkir reguler
        $shipping = 10000;

        return view('buyer.checkout', [
            'items'    => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total'    => $subtotal + $shipping,
            'user'     => $user,
        ]);
    }

    /**
     * PROSES SIMPAN ORDER
     */
    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        $items = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('buyer.keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        // VALIDASI INPUT
        $request->validate([
            'receiver_first_name' => 'required|string|max:100',
            'receiver_last_name'  => 'nullable|string|max:100',
            'receiver_phone'      => 'required|string|max:30',
            'receiver_email'      => 'required|email',
            'shipping_address'    => 'required|string',
            // shipping_method HARUS salah satu ini:
            'shipping_method'     => 'required|string|in:reguler,express,instant',
            'payment_proof'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // gabungkan nama depan + belakang
        $receiverName = trim(
            $request->input('receiver_first_name') . ' ' . $request->input('receiver_last_name')
        );

        // hitung subtotal
        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // tentukan ongkir berdasarkan shipping_method (server side, lebih aman)
        $shippingMethod = $request->input('shipping_method', 'reguler');

        $shipping = match ($shippingMethod) {
            'express' => 20000,
            'instant' => 30000,
            default   => 10000, // reguler
        };

        $total = $subtotal + $shipping;

        // handle upload bukti pembayaran
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store(
                'payment_proofs',
                'public'
            );
        }

        // BUAT ORDER
        $order = Order::create([
            'user_id'            => $user->id,
            'order_code'         => 'ORD-' . strtoupper(Str::random(8)),
            'receiver_name'      => $receiverName,
            'receiver_phone'     => $request->receiver_phone,
            'shipping_address'   => $request->shipping_address,
            'subtotal'           => $subtotal,
            'shipping_cost'      => $shipping,
            'total'              => $total,
            'status'             => 'pending',
            'payment_method'     => 'bank_transfer',
            'shipping_method'    => $shippingMethod, // <-- dipakai di admin & seller
            'payment_status'     => $paymentProofPath ? 'waiting_verification' : 'pending',
            'payment_proof_path' => $paymentProofPath,
        ]);

        // DETAIL ORDER (ORDER_ITEMS) + KURANGI STOK
        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'price'      => $item->product->price,
                'quantity'   => $item->quantity,
                'total'      => $item->product->price * $item->quantity,
            ]);

            if ($item->product) {
                $item->product->decrement('stock', $item->quantity);
            }
        }

        // kosongkan keranjang
        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('buyer.pesanan')
            ->with('success', 'Pesanan berhasil dibuat. Kode: ' . $order->order_code);
    }

    /**
     * LIST PESANAN BUYER
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('buyer.pesanan', compact('orders'));
    }

    /**
     * BUYER KONFIRMASI PESANAN SUDAH DITERIMA
     */
    public function confirmReceived(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (! in_array($order->status, ['shipped', 'paid'])) {
            return back()->with('error', 'Status pesanan tidak bisa diselesaikan saat ini.');
        }

        $order->update([
            'status'       => 'completed',
            'delivered_at' => now(),
        ]);

        return back()->with('success', 'Terima kasih — pesanan ditandai selesai 🎉');
    }
}
