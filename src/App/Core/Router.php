<?php

    namespace App\Core;

    class Router
    {
        protected array $getRoutes = [];
        protected array $postRoutes = [];

        /**
         * Register a GET route
         * @param string $uri
         * @param callable|array $action
         * @return void
         */
        public function get(string $uri, callable|array $action): void
        {
            $this->getRoutes[$uri] = $action;
        }

        /**
         * Register a POST route
         * @param string $uri
         * @param callable|array $action
         * @return void
         */
        public function post(string $uri, callable|array $action): void
        {
            $this->postRoutes[$uri] = $action;
        }

        public function dispatch(string $uri, string $method)
        {
            // Normalize the uri
            $uri = rtrim($uri, '/') ?: '/';

            if ($method === "GET" && isset($this->getRoutes[$uri])) {
                return $this->callAction($this->getRoutes[$uri]);
            }
            if ($method === "POST" && isset($this->postRoutes[$uri])) {
                return $this->callAction($this->postRoutes[$uri]);
            }
            // If no routes matched
            http_response_code(404);
            echo "404 Not Found";
            return null;
        }

        /**
         * Call the provided action, which might be:
         *  - a Closure (callable)
         *  - an array like [ControllerClass::class, 'methodName']
         */
        public function callAction(callable|array $action)
        {
            if (is_callable($action)) {
                // If it's a closure or function, just call it
                return call_user_func($action);
            }

            // If it's an array [ControllerClass, method], we instantiate and call
            [$controllerClass, $method] = $action;

            $controller = new $controllerClass();
            return $controller->$method();
        }

    }