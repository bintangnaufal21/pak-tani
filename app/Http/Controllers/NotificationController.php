<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(30);

        $unreadCount = Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        $role = $user->role ?? 'buyer';

        // route kembali berdasarkan role
        $backRoute = match ($role) {
            'admin' => route('admin.dashboard'),
            'seller' => route('seller.dashboard'),
            default => route('buyer.home'),
        };

        $layoutComponent = match ($role) {
            'admin' => 'layoutAdmin',
            'seller' => 'layoutSeller',
            default => 'layoutBuyer',
        };

        return view('notifications.index', compact(
            'notifications',
            'unreadCount',
            'role',
            'backRoute',
            'layoutComponent'
        ));
    }


    public function markRead(Request $request, $id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (! $notification) {
            return back()->with('error', 'Notifikasi ini bukan milik Anda.');
        }

        $notification->update(['read_at' => now()]);

        return back()->with('success', 'Notifikasi berhasil ditandai.');
    }



    public function markAllRead(Request $request)
    {
        $user = $request->user();

        Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return back();
    }
}
