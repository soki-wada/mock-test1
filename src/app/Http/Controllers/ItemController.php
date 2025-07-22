<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;




class ItemController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $products = Product::KeywordSearch($request->keyword)->get();

        return view('index', compact('products', 'keyword'));
    }

    public function detail($item_id){
        $item = Product::with([
            'favorites', 'comments.user.profile', 'categories', 'condition'
            ])->find($item_id);

            return view('detail', compact('item'));
    }

    public function comment(CommentRequest $request, $item_id){
        $comment = $request->only('content');
        $comment['user_id'] = Auth::id();
        $comment['product_id'] = $item_id;
        Comment::create($comment);
        return redirect("/item/$item_id");
    }

    public function showPurchase($item_id){
        Log::info('受け取った item_id:', ['id' => $item_id]);
        $product = Product::findOrFail($item_id);

        $user = Auth::user();
        $profile = $user->profile;

        $postal_code = session('purchase_postal_code') ?? $profile->postal_code;
        $address = session('purchase_address') ?? $profile->address;
        $building = session('purchase_building') ?? $profile->building;


        return view('purchase', compact('product', 'profile', 'postal_code', 'address', 'building'));
    }

    public function showAddress($item_id){
        $user = Auth::user();
        $profile = $user->profile;

        return view('address', compact('item_id', 'profile'));
    }

    public function updateAddress(Request $request, $item_id){
        session([
            'purchase_postal_code' => $request->postal_code,
            'purchase_address'     => $request->address,
            'purchase_building'    => $request->building,
        ]);

        return redirect("/purchase/{$item_id}");
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

    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $product = Product::findOrFail($request->product_id); // 商品IDはhiddenで送信する

        session([
            'purchase_postal_code' => $request->postal_code,
            'purchase_address'     => $request->address,
            'purchase_building'    => $request->building,
        ]);



        $session =  \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $product->price, // 例: 1000 = ¥1000
                    'product_data' => [
                        'name' => $product->name,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('purchase.form', ['item_id' => $product->id]),
            'metadata' => [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]
        ]);

        return redirect($session->url);
    }

    public function purchase(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($request->get('session_id'));

        // メタデータから情報を取得（セッション作成時に渡しておく）
        $productId = $session->metadata->product_id;
        $userId = $session->metadata->user_id;

        // ログインしていなければ、ここでログインさせてもよい（オプション）
        if (!Auth::check()) {
            Auth::loginUsingId($userId);
        }
        
        // 購入登録（POST不要で直接処理）
        Purchase::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'payment' => 1,
            'postal_code' => session('purchase_postal_code'),
            'address' => session('purchase_address'),
            'building' => session('purchase_building'),
        ]);

        Product::where('id', $productId)->update(['is_purchased' => 1]);

        // セッション情報をクリア
        session()->forget([
            'purchase_postal_code',
            'purchase_address',
            'purchase_building',
        ]);

        return redirect('/');
    }
}
