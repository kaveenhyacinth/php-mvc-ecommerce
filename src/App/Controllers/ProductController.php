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
    }