<?php

    use App\Controllers\ProductController;
    use App\Core\Router;

    use function App\Helpers\view;

    $router = new Router();

    $router->get('/', function () {
        view('index');
    });

    $router->get('/products', [ProductController::class, 'index']);

    return $router;
