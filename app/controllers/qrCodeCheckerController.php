<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/userService.php';



class QrCodeCheckerController extends Controller
{
  private $userService;
  private $user;


  function __construct()
  {

    $this->userService = new UserService();
    $this->user = $this->userService->getUserByEmail($_SESSION['user_email']);


  }


  public function index()
  { 
    echo $this->user->getFirstname();
    require __DIR__ . '/../views/qrCodeChecker/index.php';

  }

  
}

?>