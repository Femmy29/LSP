<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        //psanan msih jln
        $pesananAktif = Order::where('user_id', $userId)
            ->whereIn('status', ['pending', 'diterima'])
            ->count();

        //psanan blm ad bb
        $perluBayar = Order::where('user_id', $userId)
            ->where('status', 'diterima')
            ->whereDoesntHave('payment')
            ->count();

        //pngumuman
        $pengumumanTerbaru = Announcement::latest()->first();

        return view('pelanggan.dashboard', compact('pesananAktif', 'perluBayar', 'pengumumanTerbaru'));
    }
}
