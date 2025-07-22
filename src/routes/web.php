<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index']);
Route::get('/search', [ItemController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'storeUser']);
Route::middleware('auth')->group(function(){
Route::get('/email/verify', [UserController::class, 'emailAuth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage/profile'); //プロフィール
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::post('/item/{item_id}', [ItemController::class, 'comment']);
Route::get('/purchase/success', [ItemController::class, 'purchase'])->name('purchase.success');
Route::get('/purchase/{item_id}', [ItemController::class, 'showPurchase'])->name('purchase.form');

Route::get('/purchase/address/{item_id}', [ItemController::class, 'showAddress']);
Route::post('/purchase/address/{item_id}', [ItemController::class, 'updateAddress']);
Route::post('/purchase/checkout', [ItemController::class, 'checkout']);


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::get('/mypage/profile', [UserController::class, 'showProfile']);
Route::post('/mypage/profile', [UserProfileController::class, 'storeProfile']);
Route::get('/mypage', [UserProfileController::class, 'showMypage']);
Route::get('/sell', [ItemController::class, 'showSell']);
Route::post('/sell', [ItemController::class, 'sell']);
});
// Route::get('/', function () {
//     return view('welcome');
// });
