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

    protected function handleException($exception) {
        $data = [
            'error1' => $exception->getMessage()
        ];
        $this->displayExceptionView($data);
    }
    
    protected function handleError($errorMessage) {
        $data = [
            'error' => $errorMessage
        ];
        $this->displayErrorView($data);
    }
    
    protected function displayExceptionView($data) {
        $directory = substr(get_class($this), 0, -10);
        $view = "exception"; // Or whatever your exception view is named
        require __DIR__ . "/../views/$directory/$view.php";
    }
    
    protected function displayErrorView($data) {
        $directory = substr(get_class($this), 0, -10);
        $view = "error"; // Or whatever your error view is named
        require __DIR__ . "/../views/$directory/$view.php";
    }
}