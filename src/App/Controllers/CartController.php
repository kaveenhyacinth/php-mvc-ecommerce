<?php

    namespace App\Controllers;

    use App\Models\Cart;

    use function App\Helpers\view;

    class CartController
    {
        private function createCartSession(Cart $cartModel): string
        {
            $cartSessionId = $cartModel->getCartSessionId();
            $cartId = $cartModel->fetchCartBySessionId($cartSessionId);

            if (!$cartId) {
                $cartId = $cartModel->createCart($cartSessionId);
            }

            return $cartId;
        }

        public function index(): void
        {
            $cartModel = new Cart();
            $cartId = $this->createCartSession($cartModel);
            $cartItems = $cartModel->fetchCartItems($cartId);
            $cartTotal = $cartModel->getCartTotal($cartItems);

            view('cart/index', [
              'cartItems' => $cartItems,
              'cartTotal' => $cartTotal
            ]);
        }

        public function create(): void
        {
            $cartModel = new Cart();
            $cartId = $this->createCartSession($cartModel);

            $productId = $_POST['product_id'];
            if ($productId) {
                $cartModel->addToCart($cartId, $productId);
            }

            $cartItems = $cartModel->fetchCartItems($cartId);
            $cartTotal = $cartModel->getCartTotal($cartItems);


            view('cart/index', [
              'cartItems' => $cartItems,
              'cartTotal' => $cartTotal
            ]);
        }
    }