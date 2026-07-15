<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        //menu unggulan
        $menuUnggulan = Menu::where('tersedia', true)->where('unggulan', true)->take(3)->get();

        if ($menuUnggulan->isEmpty()) {
            $menuUnggulan = Menu::where('tersedia', true)->latest()->take(3)->get();
        }

        return view('home', compact('menuUnggulan'));
    }
}
