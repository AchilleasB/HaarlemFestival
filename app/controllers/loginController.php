<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../services/userService.php';

class LoginController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $this->login();
        $this->displayView($this);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $captchaResponse = $_POST['g-recaptcha-response'];
            $captchaSuccess = $this->userService->verifyCaptchaResponse($captchaResponse);

            if (empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['errorMessage'] = 'Please fill in both email and password.';
            } elseif (!$captchaSuccess) {
                $_SESSION['errorMessage'] = "Verify that you are not a robot";
            } else {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

                $user = $this->userService->getUserByEmail($validEmail);

                if (!$user) {
                    $_SESSION['errorMessage'] = 'Invalid email.';
                } elseif (password_verify($password, $user->getPassword())) {

                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_firstname'] = $user->getFirstname();
                    $_SESSION['user_lastname'] = $user->getLastname();
                    $_SESSION['user_email'] = $user->getEmail();
                    $_SESSION['user_role'] = $user->getRole();
                    $_SESSION['user_registration_date'] = $user->getRegistrationDate();

                    header('Location: /home');
                    exit();

                } else {
                    $_SESSION['errorMessage'] = 'Invalid password.';
                }
            }
            header('Refresh: 2; URL=/login');
            return;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /home');
        exit();
    }

}