<?php

    use App\Controllers\ProductController;
    use App\Core\Router;

    $router = new Router();

    $router->get('/', [ProductController::class, 'index']);
    $router->get('/{id}', [ProductController::class, 'show']);

    return $router;
