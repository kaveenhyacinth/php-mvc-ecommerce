<?php

    namespace App\Controllers;

    use App\Models\Cart;
    use App\Models\Product;

    use function App\Helpers\view;

    class ProductController
    {
        public function index(): void
        {
            $product = new Product();
            $products = $product->fetchAll();

            $cart = new Cart();
            $cartId = $cart->fetchCartBySessionId($cart->getCartSessionId());
            $cartItemCount = $cart->fetchCartItemsCount($cartId);

            view('product/index', ['products' => $products, 'cartItemCount' => $cartItemCount]);
        }

        public function show(int $id): void
        {
            $product = new Product();
            $product = $product->fetchById($id);

            view('product/show', ['product' => $product]);
        }
    }