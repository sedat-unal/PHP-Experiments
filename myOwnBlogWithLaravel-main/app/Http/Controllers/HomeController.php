<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Slider;
use App\Models\Texts;
use App\Models\User;
use App\Models\Menu;
use App\Models\socialMedia;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $sliders        = Slider::all();
        $texts          = Texts::all();
        $categories     = Categories::all();
        $users          = User::all();
        $popularTexts   = DB::select('select * from texts order by textHowManySeen desc');
        $menu           = Menu::all();
        $socialMedia    = DB::select('select * from socialMedia where status = ?', [1]);

        return response()->view('layouts.content', [
            'sliders'       => $sliders,
            'texts'         => $texts,
            'categories'    => $categories,
            'users'         => $users,
            'popularTexts'  => $popularTexts,
            'menu'          => $menu,
            'socialMedia'   => $socialMedia,
        ]);
    }
}
