<?php

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/userService.php';


class HomeController extends Controller
{  private $userService;

    private $user;

    function __construct()
    {
        $this->userService = new UserService();
        $this->user = $this->userService->getUserByEmail('iuma710@outlook.com');
      
    }
    public function index()
    {
        $this->displayView($this);
    }

}