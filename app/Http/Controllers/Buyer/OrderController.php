<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\NotifyService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            'shipping_cost'       => 'nullable|numeric|min:0',
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

        // If shipping_cost provided (from form), prefer it (but still numeric)
        if ($request->filled('shipping_cost')) {
            $shipping = (float) $request->input('shipping_cost', $shipping);
        }

        $total = $subtotal + $shipping;

        // handle upload bukti pembayaran
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store(
                'payment_proofs',
                'public'
            );
        }

        // gunakan transaction untuk atomicity
        DB::beginTransaction();
        try {
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
                    // jangan turunkan stok di bawah 0 (opsional)
                    $newStock = max(0, $item->product->stock - $item->quantity);
                    $item->product->update(['stock' => $newStock]);
                }
            }

            // kosongkan keranjang
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            // log jika perlu, lalu kembalikan error
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }

        // ----- NOTIFIKASI -----
        // notify admins
        $admins = User::where('role', 'admin')->pluck('id')->toArray();
        foreach ($admins as $adminId) {
            NotifyService::notify($adminId, 'order.created', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'message' => 'Pesanan baru dibuat: ' . $order->order_code,
            ]);
        }

        // notify sellers involved (unique)
        $sellerIds = $order->items->map(fn($i) => optional($i->product)->user_id)
            ->filter()->unique()->values()->toArray();

        foreach ($sellerIds as $sid) {
            NotifyService::notify($sid, 'order.seller_new', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'message' => 'Ada pesanan baru yang berisi produk Anda (' . $order->order_code . ')',
            ]);
        }

        // notify buyer (confirmation)
        NotifyService::notify($user->id, 'order.created.buyer', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'message' => 'Pesanan kamu berhasil dibuat: ' . $order->order_code,
        ]);

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

        // notify sellers that buyer marked complete (only sellers involved)
        $sellerIds = $order->items->map(fn($i) => optional($i->product)->user_id)
            ->filter()->unique()->values()->toArray();

        foreach ($sellerIds as $sid) {
            NotifyService::notify($sid, 'order.completed', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'message' => 'Pembeli menandai pesanan ' . $order->order_code . ' sebagai selesai.',
            ]);
        }

        // notify buyer (confirmation)
        NotifyService::notify($order->user_id, 'order.completed.buyer', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'message' => 'Pesanan ' . $order->order_code . ' berhasil diselesaikan. Terima kasih.',
        ]);

        return back()->with('success', 'Terima kasih — pesanan ditandai selesai 🎉');
    }
}
