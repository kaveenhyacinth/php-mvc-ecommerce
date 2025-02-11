<?php

    namespace App\Controllers;

    use App\Models\Cart;
    use Ramsey\Uuid\UuidFactory;

    use function App\Helpers\view;

    class CartController
    {
        private function createCartSession(Cart $cartModel): string
        {
            $cartSessionName = 'PESHC';
            if (!isset($_COOKIE[$cartSessionName])) {
                $uuid = new UuidFactory();
                $cartSessionId = $uuid->uuid4();
                $expiryTime = time() + (10 * 365 * 24 * 60 * 60);
                setcookie($cartSessionName, $cartSessionId, [
                  'expires' => $expiryTime,
                  'path' => '/',
                  'httponly' => true,
                ]);
            } else {
                $cartSessionId = $_COOKIE[$cartSessionName];
            }

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

            view('cart/index', [
              'cartItems' => $cartItems
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


            view('cart/index', [
              'cartItems' => $cartItems
            ]);
        }
    }