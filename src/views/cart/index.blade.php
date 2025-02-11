@extends('layouts.app')

@section('title', 'Cart | Shoeman Hub')

@section('content')
    <div class="products">
        <p>All Products</p>
        <ul class="product__list">
            @foreach($cartItems as $product)
                <li class="product__list__item">
                    <div class="product">
                        <div>
                            <img src="{{$product['image']}}"
                                 alt="product image" width="260" height="300"/>
                        </div>
                        <div class="product__content">
                            <h2 class="content__header">{{$product['title']}}</h2>
                            <p class="content__excerpt">{{$product['description'] ?? "something"}}</p>
                        </div>
                        <p class="product__price">
                            <span>USD</span>
                            {{$product['price']}}
                        </p>
                        <div class="product__rating">
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
