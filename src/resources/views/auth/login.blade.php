@extends('layouts.app')

@section('title')
ログイン
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="login-content">
    <div class="login-form-wrapper">
        @csrf
        <h2 class="login-form-title">
            ログイン
        </h2>
        <div class="login-form-item">
            <p class="login-form-item-title">メールアドレス</p>
            <input type="email" class="login-form-item-input">
        </div>
        <div class="login-form-item">
            <p class="login-form-item-title">パスワード</p>
            <input type="password" class="login-form-item-input">
        </div>
        <div class="login-form-button-wrapper">
            <button class="login-form-button" type="submit">
                ログインする
            </button>
        </div>
        <a href="/register" class="login-form-register">
            会員登録はこちら
        </a>
    </div>
</div>
@endsection