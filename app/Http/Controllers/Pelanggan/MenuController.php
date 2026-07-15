<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::where('tersedia', true)->orderBy('kategori')->get();

        return view('pelanggan.menu.index', compact('menu'));
    }
}
