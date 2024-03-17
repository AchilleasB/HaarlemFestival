<?php

class Controller
{
    public function displayView($model)
    {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        require __DIR__ . "/../views/$directory/$view.php";
    }

    public function displayYummyView($model, $data = [])
    {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        if (!empty($data)) {
            extract($data);
        }

        require __DIR__ . "/../views/$directory/$view.php";
    }

    public function displayOrders($model, $data = [])
    {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        if (!empty($data)) {
            extract($data);
        }

        require __DIR__ . "/../views/$directory/$view.php";
    }
}