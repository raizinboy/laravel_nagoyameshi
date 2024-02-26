<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $review_average_lists = [];
        $shops_id = Shop::pluck('id');
        foreach($shops_id as $shop_id) {
            $review_average = 0;
            $review_average = round(Review::where('shop_id', $shop_id )->pluck('score')->avg(),1); 
            $review_average_lists[$shop_id] = $review_average;
        }

        if ($request->input('category') !== null) {
            $shops = Shop::where('category_id', $request->input('category'))->sortable()->paginate(10);
            $total_count = Shop::where('category_id', $request->input('category'))->count();
            $category_id = $request->input('category');
            $shop = Category::find($request->input('category'));
        } else {
            $shops = Shop::sortable()->paginate(10);
            $total_count = shop::count();
            $shop = null;
            $category_id = "";
        }

        
        $categories = Category::all();

        return view('shops.index', compact('shops', 'categories', 'shop', 'total_count', 'category_id','review_average_lists' ));
    }

   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $reviews = $reviews = $shop->reviews()->get();
        $review_average =round(Review::where('shop_id', $shop->id)->pluck('score')->avg(),1);
        

        return view('shops.show', compact('shop', 'reviews', 'review_average'));
    }

    public function favorite(Shop $shop)
    {
        Auth::user()->togglefavorite($shop);

        return back();
    }

}
