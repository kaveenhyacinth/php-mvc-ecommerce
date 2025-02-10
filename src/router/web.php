<?php

    use App\Controllers\ProductController;
    use App\Core\Router;

    $router = new Router();

    $router->get('/', [ProductController::class, 'index']);
//    $router->get('/products', [ProductController::class, 'index']);

    return $router;
