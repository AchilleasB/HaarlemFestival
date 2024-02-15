<?php

class PatternRouter
{
    public function route($uri)
    {
        // check if we are requesting an api route
        $api = false;
        if (str_starts_with($uri, "api/")) {
            $uri = substr($uri, 4);
            $api = true;
        }

        // set default controller/method
        $defaultcontroller = 'home';
        $defaultmethod = 'index';

        $uri = $this->stripParameters($uri);

        $explodedUri = explode('/', $uri);
        

        if (!isset($explodedUri[0]) || empty($explodedUri[0])) {
            $explodedUri[0] = $defaultcontroller;
        }
        $controllerName = $explodedUri[0] . "Controller";

        if (!isset($explodedUri[1]) || empty($explodedUri[1])) {
            $explodedUri[1] = $defaultmethod;
        }
        $methodName = $explodedUri[1];

        $additionalSegments = array_slice($explodedUri, 2);

        $controllerFilePath = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if ($api) {
            $controllerFilePath = __DIR__ . '/../api/controllers/' . $controllerName . '.php';
        }

        if (file_exists($controllerFilePath)) {
            require($controllerFilePath);

            try {
                $controllerObj = new $controllerName();
                $controllerObj->$methodName(...$additionalSegments);
            } catch (Exception $e) {
                $this->handle404();
            }
        } else {
            $this->handle404();
        }
    }

    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    private function handle404() {
        // URL not found
        http_response_code(404);
        require __DIR__ . '/../views/404.php';
        exit;
    }
    
}
