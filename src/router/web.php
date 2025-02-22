<?php

    use App\Controllers\CartController;
    use App\Controllers\ProductController;
    use App\Core\Router;

    $router = new Router();

    $router->get('/', [ProductController::class, 'index']);
    $router->get('/product/{id}', [ProductController::class, 'show']);

    $router->get('/cart', [CartController::class, 'index']);
    $router->post('/cart', [CartController::class, 'create']);
    $router->put('/cart', [CartController::class, 'update']);
    $router->delete('/cart', [CartController::class, 'delete']);

    return $router;
