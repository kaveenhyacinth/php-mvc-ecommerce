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

        protected function convertUriToRegex(string $routeUri): string
        {
            // 1) Escape all regex special characters in the route *except* for our {placeholders}
            //    We'll do this by quoting everything, then carefully replace the quoted placeholders.

            // First, preg_quote everything using a chosen delimiter (#)
            $pattern = preg_quote($routeUri, '#');
            // Now $pattern will have escaped curly braces: \{ and \}.
            // For placeholders like \{id\}, we want to turn them into a capture group: ([^/]+).

            // 2) Replace the quoted placeholder \{...\} with the capturing group
            //    Notice we look for \\\{ (escaped) then any characters ^} then \\\}
            $pattern = preg_replace('#\\\{[^}]+\\\}#', '([^/]+)', $pattern);

            // 3) Add ^ and $ to match the full string
            //    Use # as the delimiter
            return '#^' . $pattern . '$#';
        }

        public function dispatch(string $uri, string $method)
        {
            // Normalize the uri
            $uri = rtrim($uri, '/') ?: '/';

            $routes = [];

            if ($method === "GET") {
                $routes = $this->getRoutes;
            }
            if ($method === "POST") {
                $routes = $this->postRoutes;
            }

            foreach ($routes as $routeUri => $action) {
                // Convert something like "/products/{id}" to a regex
                $pattern = $this->convertUriToRegex($routeUri);

                // Try matching
                if (preg_match($pattern, $uri, $matches)) {
                    // $matches[1], $matches[2], etc. will be your captured values
                    // Remove the full match from the beginning of $matches
                    array_shift($matches);

                    return $this->callAction($action, $matches);
                }
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
        public function callAction(callable|array $action, array $params = [])
        {
            if (is_callable($action)) {
                // If it's a closure or function, just call it with parameters
                return call_user_func_array($action, $params);
            }

            // If it's an array [ControllerClass, method], we instantiate and call
            [$controllerClass, $method] = $action;
            $controller = new $controllerClass();

            return call_user_func_array([$controller, $method], $params);
        }

    }