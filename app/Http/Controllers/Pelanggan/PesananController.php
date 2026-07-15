<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    //psanan planggan
    public function index()
    {
        $pesanan = Order::with(['items.menu', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pelanggan.pesanan.index', compact('pesanan'));
    }

    //psanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|array|min:1',
            'menu_id.*' => 'exists:menus,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'nullable|integer|min:0',
        ], [
            'menu_id.required' => 'Pilih minimal satu menu untuk dipesan.',
        ]);

        //filter menu lebih dri 0
        $dipilih = [];
        foreach ($validated['menu_id'] as $index => $menuId) {
            $jumlah = (int) ($validated['jumlah'][$index] ?? 0);
            if ($jumlah > 0) {
                $dipilih[$menuId] = $jumlah;
            }
        }

        if (empty($dipilih)) {
            return back()->with('error', 'Silakan masukkan jumlah minimal 1 untuk salah satu menu.');
        }


        DB::transaction(function () use ($dipilih) {
            $menus = Menu::whereIn('id', array_keys($dipilih))->get()->keyBy('id');
            $total = 0;

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_harga' => 0, //update item
                'status' => 'pending',
            ]);

            foreach ($dipilih as $menuId => $jumlah) {
                $menu = $menus[$menuId];
                $subtotal = $menu->harga * $jumlah;
                $total += $subtotal;

                $order->items()->create([
                    'menu_id' => $menuId,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ]);
            }

            $order->update(['total_harga' => $total]);
        });

        return redirect()->route('pelanggan.pesanan.index')->with('success', 'Pesanan berhasil dibuat, menunggu verifikasi admin.');
    }
}
