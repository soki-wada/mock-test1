<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/register', [UserController::class, 'register']);
//view確認用ルート
Route::get('/email_auth', [UserController::class, 'email_auth']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
// Route::get('/', function () {
//     return view('welcome');
// });
