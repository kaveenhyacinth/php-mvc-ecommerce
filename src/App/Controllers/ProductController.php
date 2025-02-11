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

            view('product/index', ['products' => $products]);
        }

        public function show(int $id): void
        {
            $product = new Product();
            $product = $product->fetchById($id);

            view('product/show', ['product' => $product]);
        }

        public function test(): void
        {
            $product = new Product();
            $products = $product->fetchAll();

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($products);
        }
    }