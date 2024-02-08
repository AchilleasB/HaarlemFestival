<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../services/userService.php';

class RegistrationController extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
        $this->register();
        $this->displayView($this);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $captchaResponse = $_POST['g-recaptcha-response'];
            $captchaSuccess = $this->userService->verifyCaptchaResponse($captchaResponse);

            if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['errorMessage'] = "All fields are required";
                header('Location: /registration');
                exit;
            } else {
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                if (!$captchaSuccess) {
                    $_SESSION['errorMessage'] = "Verify that you are not a robot";
                } elseif ($this->userService->userExists($email)) {
                    $_SESSION['errorMessage'] = "User already exists";
                } elseif (!$this->userService->validatePassword($password)) {
                    $_SESSION['errorMessage'] = "Password must be between 8 and 20 characters";
                } else {
                    $user = $this->userService->mapToCustomer($firstname, $lastname, $email, $password);
                    $this->userService->register($user);

                    $_SESSION['successMessage'] = "You have successfully registered!\nYou can now log in.";
                    sleep(1);

                    header('Location: /login');
                    exit;
                }
                header('Refresh: 2; URL=/registration');
                return;
            }
        }
    }
}