<?php

    namespace App\Controllers;

    use App\Models\Product;

    use function App\Helpers\view;

    class ProductController
    {
        public function index(): void
        {
            $product = new Product();
            $products = $product->fetchAll();

            view('products/index', ['products' => $products]);
        }

        public function show(int $id): void
        {
            $product = new Product();
            $product = $product->fetchById($id);

            view('products/show', ['product' => $product]);
        }
    }