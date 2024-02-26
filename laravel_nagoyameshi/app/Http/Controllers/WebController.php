<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
//ここにストアのモデルを追加

class WebController extends Controller
{
    public function index()
    {
        $recommend_shops = Shop::where('recommend_flag', true)->take(4)->get();
        return view('web.index', compact('recommend_shops'));
    }
}


