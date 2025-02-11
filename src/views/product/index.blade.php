@extends('layouts.app')

@section('title', 'All Products | Shoeman Hub')

@section('content')
    <div class="products">
        <p>All Products</p>
        <ul class="product__list">
            @foreach($products as $product)
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
                        <div class="product__actions">
                            <form action="/cart" method="POST">
                                <input type="hidden" name="product_id" value="{{$product['id']}}">
                                <button type="submit">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
