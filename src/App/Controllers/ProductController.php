<?php

    namespace App\Controllers;

    use function App\Helpers\view;

    class ProductController
    {
        public function index()
        {
            view('products/index', ['products' => []]);
        }

    }