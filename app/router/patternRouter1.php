<?php

class PatternRouter {
    private $routes;
    private $api;

    public function __construct($routes) {
        $this->routes = $routes;
        $this->api = false;
    }

    public function route($uri) {

        $uri = $this->stripParameters($uri);
        $segments = explode('/', $uri);

        // Provide default route
        $route = $this->routes;
        if (!isset($segments[0]) || empty($segments[0])) {
            $segments[0] = 'home';
        }

        // Loop through each segment of the URI to find the matching route
        foreach ($segments as $segment) {
            if (isset($route['children'][$segment])) {
                $route = $route['children'][$segment];
            } else if (isset($route[$segment])) {
                $route = $route[$segment];
            } else {
                // If any segment does not match a route, throw a 404 error
                $this->handle404();
            }
        }
        
        // Determine the controller and method to use
        if (isset($route['callback'])) {
            $callbackResult = $route['callback']();
            $controllerName = $callbackResult['controller'];
            $methodName = $callbackResult['method'];
        } else {
            $controllerName = $route['controller'];
            $methodName = isset($route['method']) ? $route['method'] : 'index';
        }

        // Check if the user has access to the route
        if ($this->checkAccess($route)) {
            $controllerFilePath = __DIR__ . '/../controllers/' . $controllerName . '.php';

            if ($this->api) {
                $controllerFilePath = __DIR__ . '/../api/controllers/' . $controllerName . '.php';
            }

            if (file_exists($controllerFilePath)) {
                require($controllerFilePath);
                try {
                    $controllerObj = new $controllerName();
                    $controllerObj->$methodName();
                } catch(Error $e) {
                    // For some reason the class/method doesn't load
                    //$this->handle500();
                }
            } else {
                // Controller/method matching the URL not found
                $this->handle404();
            }
        } else {
            // Access denied
            $this->handle403();
        }
    }

    private function stripParameters($uri) {
        // Checks if we are requesting an api route
        if (str_starts_with($uri, "api/")) {
            $uri = substr($uri, 4);
            $api = true;
        }

        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    private function checkAccess($route) {
        $access = $route['access'];
        if ($access === 'all') {
            return true;
        } else if ($access === 'admin') {
            $this->checkAuthentication();
            return $_SESSION['user_role'] === 'admin';
        } else if ($access === 'customer') {
            $this->checkAuthentication();
            return $_SESSION['user_role'] === 'customer';
        } else {
            return false;
        }
    }

    private function checkAuthentication() {

        if (!(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true)) {
            require __DIR__ . '/../views/login/index.php';
            exit;
        } 

        return ;
    }

    private function handle404() {
        // URL not found
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
    }

    private function handle403() {
        // Forbidden
        http_response_code(403);
        require __DIR__ . '/../views/errors/403.php';
        exit;
    }

    private function handle500() {
        // Forbidden
        http_response_code(500);
        require __DIR__ . '/../views/errors/500.php';
        exit;
    }
}