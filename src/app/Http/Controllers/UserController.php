<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function register(){
        return view('auth.register');
    }

    public function email_auth(){
        return view('auth.email_auth');
    }
}
