<?php

    use App\App;
    use Ramsey\Uuid\UuidFactory;

    require __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $router = require __DIR__ . '/../router/web.php';
    (new App($router, [
      'host' => $_ENV['DB_HOST'],
      'database' => $_ENV['DB_DATABASE'],
      'username' => $_ENV['DB_USER'],
      'password' => $_ENV['DB_PASS'],
      'driver' => $_ENV['DB_DRIVER'] ?? 'mysql'
    ]))->run();

    $db = App::db();

    $query = 'SELECT * FROM products';
    $stmt = $db->prepare($query);
    $stmt->execute();

    //    var_dump($stmt->fetchAll());

