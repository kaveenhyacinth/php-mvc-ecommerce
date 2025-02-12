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
                                                <div class="content__price__qty">
                                                    <form action="/cart" method="POST">
                                                        <input type="hidden" name="__method" value="PUT"/>
                                                        <input type="hidden" name="product_id"
                                                               value="{{$cartItem['product_id']}}"/>
                                                        <input type="hidden" name="cart_id"
                                                               value="{{$cartItem['cart_id']}}"/>
                                                        <input name="quantity" class="quantity-input" type="number"
                                                               value="{{$cartItem['quantity']}}" min="1"
                                                               onchange="this.form.submit()"/>
                                                    </form>
                                                </div>
                                                <div class="content__price__dlt">
                                                    <form action="/cart" method="POST">
                                                        <input type="hidden" name="__method" value="DELETE"/>
                                                        <input type="hidden" name="product_id"
                                                               value="{{$cartItem['product_id']}}"/>
                                                        <input type="hidden" name="cart_id"
                                                               value="{{$cartItem['cart_id']}}"/>
                                                        <button type="submit">
                                                            <img src="assets/images/bin.svg" alt="delete icon"
                                                                 width="24" height="24"/>
                                                        </button>
                                                    </form>
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
                            <button onclick="alert('Checkout has not been implemented yet! 😢')">Proceed to Checkout
                            </button>
                            <a href="/">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="cart__empty">
                    <p>Your cart is empty</p>
                    <a href="/">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>

@endsection
