<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AkunController extends Controller
{
    //dftar planggan
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $akun = User::where('role', 'customer')
            ->when($status !== 'semua', fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10);

        return view('admin.akun.index', compact('akun', 'status'));
    }

    //nrima pndftran akun
    public function terima(User $akun)
    {
        $akun->update(['status' => 'accepted']);

        return back()->with('success', "Akun {$akun->name} berhasil diverifikasi dan diterima.");
    }

    //mnolak pndftran akun
    public function tolak(User $akun)
    {
        $akun->update(['status' => 'rejected']);

        return back()->with('success', "Akun {$akun->name} ditolak.");
    }
}
