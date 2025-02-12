<?php

    namespace App\Controllers;

    use App\Models\Cart;

    use function App\Helpers\view;

    class CartController
    {
        public function index(): void
        {
            $cartModel = new Cart();
            $cartId = $this->createCartSession($cartModel);

            $this->renderCartView($cartModel, $cartId);
        }

        public function create(): void
        {
            $cartModel = new Cart();
            $cartId = $this->createCartSession($cartModel);

            $productId = $_POST['product_id'];
            if ($productId) {
                $cartModel->addToCart($cartId, $productId);
            }

            $this->renderCartView($cartModel, $cartId);
        }

        public function update(): void
        {
            $quantity = $_POST['quantity'];
            $cartItemId = $_POST['product_id'];
            $cartId = $_POST['cart_id'];

            $cartModel = new Cart();
            $cartModel->updateQuantity($cartId, $cartItemId, $quantity);

            $this->renderCartView($cartModel, $cartId);
        }

        public function delete(): void
        {
            $cartItemId = $_POST['product_id'];
            $cartId = $_POST['cart_id'];

            $cartModel = new Cart();
            $cartModel->deleteCartItem($cartId, $cartItemId);

            $this->renderCartView($cartModel, $cartId);
        }

        private function createCartSession(Cart $cartModel): string
        {
            $cartSessionId = $cartModel->getCartSessionId();
            $cartId = $cartModel->fetchCartBySessionId($cartSessionId);

            if (!$cartId) {
                $cartId = $cartModel->createCart($cartSessionId);
            }

            return $cartId;
        }

        private function renderCartView(Cart $cartModel, string $cartId): void
        {
            $cartItems = $cartModel->fetchCartItems($cartId);
            $cartTotal = $cartModel->getCartTotal($cartItems);

            view('cart/index', [
              'cartItems' => $cartItems,
              'cartTotal' => $cartTotal
            ]);
        }
    }