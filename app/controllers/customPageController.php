<?php

class CustomPageController
{
    public function viewPage($pageName)
    {
        $pagePath = __DIR__ . '/../views/customPage/' . $pageName . '.php';
        if (file_exists($pagePath)) {
            require $pagePath;
        } else {
            // Handle page not found, could redirect to a 404 page
            header('HTTP/1.0 404 Not Found');
            echo 'Page not found.';
            exit;
        }
    }
}