@extends('layouts.app')

@section('title', 'Cart | Shoeman Hub')
@section('cartCount', count($cartItems))

@section('content')
    <div id="cart-index">
        <h2>Your Cart</h2>
        <div class="cart__container">
            @if(count($cartItems) > 0)
                <div class="cart__box">
                    <div class="cart__box__products">
                        <ul class="cart__list">
                            @foreach($cartItems as $cartItem)
                                <li class="cart__list__item">
                                    <div class="cart__item">
                                        <div class="cart__item__image-container">
                                            <img src="{{$cartItem['image']}}"
                                                 alt="product image"/>
                                        </div>
                                        <div class="cart__item__content">
                                            <h3 class="content__header">{{$cartItem['title']}}</h3>
                                            <div class="content__price">
                                                <p><span>USD</span> {{$cartItem['price']}} x</p>
                                                <div>
                                                    <input class="quantity-input" type="number"
                                                           value="{{$cartItem['quantity']}}" min="1"/>
                                                </div>
                                            </div>
                                            <p class="content__total">
                                                <span>USD</span> {{$cartItem['quantity'] * $cartItem['price']}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="cart__box__info">
                        <div class="info__content">
                            <div>
                                <p>Subtotal</p>
                                <p><span>$</span>{{$cartTotal}}</p>
                            </div>
                            <button>Proceed to Checkout</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
