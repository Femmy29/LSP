<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $pesanan = Order::with(['user', 'items.menu'])
            ->when($status !== 'semua', fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10);

        return view('admin.pesanan.index', compact('pesanan', 'status'));
    }

    public function terima(Order $pesanan)
    {
        $pesanan->update(['status' => 'diterima']);

        return back()->with('success', "Pesanan #{$pesanan->id} diterima.");
    }

    public function tolak(Request $request, Order $pesanan)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255',
        ]);

        $pesanan->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', "Pesanan #{$pesanan->id} ditolak.");
    }
}
