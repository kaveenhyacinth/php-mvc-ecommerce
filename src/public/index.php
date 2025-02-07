<?php

    require __DIR__ . '/../vendor/autoload.php';

   $router = require __DIR__ . '/../router/web.php';

   $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
   $method = $_SERVER['REQUEST_METHOD'];

    $router->dispatch($uri, $method);