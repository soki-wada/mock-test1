<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
