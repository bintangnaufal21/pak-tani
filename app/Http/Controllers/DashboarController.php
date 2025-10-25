<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // <-- PENTING: Import class View

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index(): View // <-- Buat method ini
    {
        // Perintah ini akan mencari file di:
        // resources/views/dashboard.blade.php
        return view('dashboard');
    }
}
