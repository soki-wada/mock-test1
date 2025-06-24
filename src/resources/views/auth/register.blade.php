@extends('layouts.app')

@section('title')
会員登録
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-content">
    <div class="register-form-wrapper">
        <form action="" class="register-form">
            @csrf
            <h2 class="register-form-title">
                会員登録
            </h2>
            <div class="register-form-item">
                <p class="register-form-item-title">
                    ユーザー名
                </p>
                <input type="text" class="register-form-item-input">
            </div>
            <div class="register-form-item">
                <p class="register-form-item-title">メールアドレス</p>
                <input type="email" class="register-form-item-input">
            </div>
            <div class="register-form-item">
                <p class="register-form-item-title">パスワード</p>
                <input type="password" class="register-form-item-input">
            </div>
            <div class="register-form-item">
                <p class="register-form-item-title">確認用パスワード</p>
                <input type="password" name="password_confirmation" class="register-form-item-input">
            </div>
            <div class="register-form-button-wrapper">
                <button class="register-form-button" type="submit">
                    登録する
                </button>
            </div>
            <a href="/login" class="register-form-login">
                ログインはこちら
            </a>
        </form>
    </div>
</div>
@endsection