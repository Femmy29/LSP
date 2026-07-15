<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $pembayaran = Payment::with(['order.user'])
            ->when($status !== 'semua', fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10);

        return view('admin.pembayaran.index', compact('pembayaran', 'status'));
    }

    public function terima(Payment $pembayaran)
    {
        $pembayaran->update(['status' => 'diterima']);
        $pembayaran->order->update(['status' => 'selesai']);

        return back()->with('success', 'Pembayaran diterima, pesanan ditandai selesai.');
    }

    public function tolak(Payment $pembayaran)
    {
        $pembayaran->update(['status' => 'ditolak']);

        return back()->with('success', 'Pembayaran ditolak.');
    }
}
