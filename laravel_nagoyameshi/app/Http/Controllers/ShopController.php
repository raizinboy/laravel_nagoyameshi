<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        
        if($request->input('shop_name') !== null){
            if ($request->input('category') !== null) {
                $shop_name = $request->input('shop_name');
                $shops = Shop::where('category_id', $request->input('category'))->where('name', 'LIKE', "%$shop_name%" )->sortable()->paginate(10);
                $total_count = Shop::where('category_id', $request->input('category'))->where('name', 'LIKE' , "%$shop_name%")->count();
                $category = Category::find($request->input('category'));
                $category_id = $request->input('category');
            } else {
                $shop_name = $request->input('shop_name');
                $shops = Shop::where('name', 'LIKE' , "%$shop_name%")->sortable()->paginate(10);
                $total_count = shop::where('name', 'LIKE' , "%$shop_name%" )->count();
                $category = null;
                $category_id = "";
            };
        } else {
            if ($request->input('category') !== null) {
                $shops = Shop::where('category_id', $request->input('category'))->sortable()->paginate(10);
                $total_count = Shop::where('category_id', $request->input('category'))->count();
                $category = Category::find($request->input('category'));
                $category_id = $request->input('category');
                $shop_name = null;
            } else {
                $shops = Shop::sortable()->paginate(10);
                $total_count = shop::count();
                $category = null;
                $category_id = "";
                $shop_name = null;
            };
        }

        
        $categories = Category::all();

        return view('shops.index', compact('shops', 'categories', 'category', 'total_count', 'category_id','review_average_lists', 'shop_name'));
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
        


        $nowDay = Carbon::now(); 

        $setTime = $nowDay->setTime(9,0,0);
        $timestring = substr($setTime->toTimeString(), 0, 5);
        $addTimes = ["$timestring"];
        
        for($num = 1; $num <= 52; $num++ ){
            $addTime = $setTime->addMinute(15)->toTimeString();
            $timestring = substr($addTime, 0, 5);
            array_push($addTimes, "$timestring");
        }
        
        $nowDay = Carbon::now(); 
        $datestring = $nowDay->toDateString();
        $addDayLists = ["$datestring"];

        for ($i = 1 ; $i <= 30 ; $i++){ 
        $addDays = new Carbon("+$i day");
        $datestring = $addDays->toDateString();
        array_push($addDayLists, "$datestring");  
        }
        
    
        

        return view('shops.show', compact('shop', 'reviews', 'review_average','addDayLists', 'addTimes'));
    }

    public function favorite(Shop $shop)
    {
        Auth::user()->togglefavorite($shop);

        return back();
    }

}
