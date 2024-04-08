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
    if ($this->user != NULL){
      require __DIR__ . '/../views/qrCodeChecker/index.php';
      }else{
        header("location: /login");
      }

  }

  
}

?>