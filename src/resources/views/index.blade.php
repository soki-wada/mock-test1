@extends('layouts.app')

@section('title')
商品一覧ページ
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="index-content">
    <div class="section-tab">
        <a href="" class="section-tab-item">おすすめ</a>
        <a href="" class="section-tab-item">マイリスト</a>
    </div>
    <div class="product-cards">
        @foreach($products as $product)
        <div class="product-card-wrapper">
            <a href="/item/{{$product->id}}" class="product-card-detail">
                <div class="product-card-image-wrapper">
                    <img src="{{asset('storage/images/' . $product->image)}}" alt="{{$product->name}}の画像" class="product-card-image">
                </div>
                <div class="product-card-label">
                    <p class="product-card-label-name">
                        {{$product->name}}
                    </p>
                    @if($product->is_purchased == 1)
                    <p class="product-card-label-sold">sold</p>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection