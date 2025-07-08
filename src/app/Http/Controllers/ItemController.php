<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class ItemController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function detail($item_id){
        $item = Product::with([
            'favorites', 'comments.user', 'categories', 'condition'
            ])->find($item_id);

            return view('detail', compact('item'));
    }

    public function showPurchase($item_id){
        $item = Product::find($item_id);
    }

    public function showSell(){
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function sell(Request $request){
        $product = $request->only([
            'image',
            'condition_id',
            'name',
            'brand',
            'description',
            'price',
            'is_purchased'
        ]);
        $fileName = $request->file('image')->getClientOriginalName();
        $uniqueName = Str::uuid() . '_' . $fileName;
        $request->file('image')->storeAs('public/images', $uniqueName);
        $product['image'] = basename($uniqueName);

        $product['user_id'] = Auth::id();

        $product = Product::create($product);
        $product->categories()->attach($request->categories);

        return redirect('/');
    }
}
