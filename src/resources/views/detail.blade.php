@extends('layouts.app')

@section('title')
商品詳細画面
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail-content">
    <div class="product-image-wrapper">
        <img src="{{asset('storage/images/' . $item->image)}}" alt="{{$item->name}}の画像" class="product-image">
    </div>
    <div class="product-info">
        <h3 class="product-name">
            {{$item->name}}
        </h3>
        <p class="product-brand">
            {{$item->brand}}
        </p>
        <p class="product-price">
            ¥<span class="product-price-emphasis">{{number_format($item->price)}}</span>(税込)
        </p>
        <div class="product-icons">
            <div class="product-icon">
                <div class="product-icon-image-wrapper">
                    <img src="{{asset('images/favorite.png')}}" alt="お気に入りのアイコン" class="product-icon-image">
                </div>
                <p class="product-icon-amount">
                    {{count($item->favorites)}}
                </p>
            </div>
            <div class="product-icon">
                <div class="product-icon-image-wrapper">
                    <img src="{{asset('images/comment.png')}}" alt="コメントのアイコン" class="product-icon-image">
                </div>
                <p class="product-icon-amount">
                    {{count($item->comments)}}
                </p>
            </div>
        </div>
        <div class="product-purchase-form-wrapper">
            <form action="" class="product-purchase-form">
                @csrf
                <input type="hidden" value="{{$item->id}}" name="id">
                <div class="product-purchase-button-wrapper">
                    <button class="product-purchase-button" type="submit">
                        購入手続きへ
                    </button>
                </div>
            </form>
        </div>
        <h4 class="product-section-title">
            商品説明
        </h4>
        <p class="product-description">
            {{$item->description}}
        </p>
        <h4 class="product-section-title">
            商品の情報
        </h4>
        <div class="product-attribute">
            <p class="product-attribute-title">カテゴリー</p>
            <div class="product-attribute-contents">
                @foreach($item->categories as $category)
                <p class="product-attribute-content gray">{{$category->content}}</p>
                @endforeach
            </div>
        </div>
        <div class="product-attribute">
            <p class="product-attribute-title">商品の状態</p>
            <p class="product-attribute-content">{{$item->condition->content}}</p>
        </div>
        <h4 class="product-comment-title">
            コメント({{count($item->comments)}})
        </h4>
        <div class="product-comment-user">
            <div class="product-comment-user-icon-wrapper">
                <img src="{{asset('storage/images/' . $item->image)}}" alt="" class="product-comment-user-icon">
                <!-- ユーザーアイコンに変更 -->
            </div>
            <p class="product-comment-user-name">
                admin
                <!-- ユーザー名に変更 -->
            </p>
        </div>
        <p class="product-comment">
            <!-- ユーザーのコメントに変更 -->
            素晴らしい
        </p>
        <div class="product-comment-form-wrapper">
            <form action="" class="product-comment-form">
                @csrf
                <p class="product-comment-form-title">
                    商品へのコメント
                </p>
                <textarea name="" id="" class="product-comment-form-input"></textarea>
                <div class="product-comment-form-button-wrapper">
                    <button class="product-comment-form-button" type="submit">
                        コメントを送信する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection