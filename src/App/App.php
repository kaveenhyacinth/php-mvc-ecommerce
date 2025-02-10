<?php

    namespace App;

    use App\Core\Router;
    use PDO;

    class App
    {
        private static DB $db;

        /**
         * @param Router $router
         * @param array $config
         */
        public function __construct(protected Router $router, protected array $config = [])
        {
            static::$db = new DB($config);
        }

        public static function db(): DB
        {
            return static::$db;
        }

        public function run(): void
        {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $method = $_SERVER['REQUEST_METHOD'];
            $this->router->dispatch($uri, $method);
        }

    }