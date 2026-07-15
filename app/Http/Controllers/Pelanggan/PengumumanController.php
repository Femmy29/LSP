<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Announcement::latest()->paginate(9);

        return view('pelanggan.pengumuman.index', compact('pengumuman'));
    }
}
