<?php

require_once __DIR__ . '/controller.php';


class HomeController extends Controller
{  private $userService;

    function __construct()
    {
    }
    public function index()
    {
        $this->displayView($this);
    }

}