<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    //form bukti byar
    public function create(Order $pesanan)
    {
        //notif planggan
        abort_if($pesanan->user_id !== Auth::id(), 403);

        //bisa byr jika d terima
        abort_if($pesanan->status !== 'diterima', 403, 'Pesanan belum diverifikasi admin.');

        return view('pelanggan.pesanan.bayar', compact('pesanan'));
    }

    public function store(Request $request, Order $pesanan)
    {
        abort_if($pesanan->user_id !== Auth::id(), 403);
        abort_if($pesanan->status !== 'diterima', 403);

        $validated = $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'metode_pembayaran' => 'required|string|max:100',
        ], [
            'bukti_transfer.required' => 'Bukti transfer wajib diunggah.',
            'bukti_transfer.image' => 'File harus berupa gambar.',
            'bukti_transfer.max' => 'Ukuran gambar maksimal 2MB.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib diisi.',
        ]);

        $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti-bayar', 'public');

        $pesanan->payment()->create($validated);

        return redirect()->route('pelanggan.pesanan.index')->with('success', 'Bukti pembayaran berhasil diunggah, menunggu verifikasi admin.');
    }
}
