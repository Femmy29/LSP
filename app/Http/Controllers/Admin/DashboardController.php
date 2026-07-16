<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $akunPending = User::where('role', 'customer')->where('status', 'pending')->count();
        $pesananPending = Order::where('status', 'pending')->count();
        $pembayaranPending = Payment::where('status', 'pending')->count();

        return view('admin.dashboard', compact('akunPending', 'pesananPending', 'pembayaranPending'));
    }
}
