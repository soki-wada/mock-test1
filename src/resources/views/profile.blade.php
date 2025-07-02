@extends('layouts.app')

@section('title')
プロフィール設定
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection

@section('content')
<div class="profile-content">
    <form action="" class="profile-form">
        @csrf
        <h2 class="profile-form-title">
            プロフィール設定
        </h2>
        <div class="profile-form-image-setting">
            <div class="profile-form-image-wrapper">
                <img src="" alt="" class="profile-form-image">
            </div>
            <div class="profile-form-file-image">
                <label for="file-upload" class="profile-form-file-image-label">
                    画像を選択する
                </label>
                <input type="file" class="profile-form-file-image-input" id="file-upload">
            </div>
        </div>
        <p class="profile-form-section-title">
            ユーザー名
        </p>
        <div class="profile-form-input-wrapper">
            <input type="text" class="profile-form-input">
        </div>
        <p class="profile-form-section-title">
            郵便番号
        </p>
        <div class="profile-form-input-wrapper">
            <input type="text" class="profile-form-input">
        </div>
        <p class="profile-form-section-title">
            住所
        </p>
        <div class="profile-form-input-wrapper">
            <input type="text" class="profile-form-input">
        </div>
        <p class="profile-form-section-title">
            建物名
        </p>
        <div class="profile-form-input-wrapper">
            <input type="text" class="profile-form-input">
        </div>
        <div class="profile-form-button-wrapper">
            <button class="profile-form-button">
                更新する
            </button>
        </div>
    </form>
</div>
@endsection