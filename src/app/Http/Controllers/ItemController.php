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
}
