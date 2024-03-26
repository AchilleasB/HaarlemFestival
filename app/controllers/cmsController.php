<?php

require_once __DIR__ . '/controller.php';

class CmsController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {
            $this->displayView($this);
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function danceManagement()
    {
        $this->displayView($this);
    }

    public function userManagement()
    {
        $this->displayView($this);
    }

    public function yummyManagement()
    {
        $this->displayView($this);
    }

}