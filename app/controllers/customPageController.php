<?php

class CustomPageController
{
    public function viewPage($pageName)
    {
        $pagePath = __DIR__ . '/../views/customPage/' . $pageName . '.php';
        if (file_exists($pagePath)) {
            require $pagePath;
        } else {
            header('/404.php');
            exit;
        }
    }
}