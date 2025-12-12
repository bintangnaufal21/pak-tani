<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data admin yang sedang login
        $admin = Auth::user();

        return view('admin.pengaturan', compact('admin'));
    }
}
