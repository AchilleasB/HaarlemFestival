<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../services/userService.php';
require __DIR__ . '/../services/mailService.php';

class ProfileController extends Controller
{
    private $userService;
    private $mailService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->mailService = new MailService();
    }
    public function index()
    {
        $this->displayView($this);
    }
    public function resetPassword()
    {
        if (isset($_GET['token'])) {
            $_SESSION['token'] = $_GET['token'];
            $token = $_SESSION['token'];

            if ($this->userService->isExpiredToken($token)) {
                $_SESSION['errorMessage'] = 'Your link has expired. Please request a new one';
                header('Location: /profile');
                exit();
            }

            $user_id = $this->userService->getUserIdByToken($token);
            $user = $this->userService->getUserById($user_id);

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_firstname'] = $user->getFirstname();
            $_SESSION['user_lastname'] = $user->getLastname();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_role'] = $user->getRole();
        }

        $this->displayView($this);
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST['email']);

            $user = $this->userService->getUserById($id);
            if ($user->getEmail() == $email && $user->getFirstname() == $firstname && $user->getLastname() == $lastname) {
                $_SESSION['errorMessage'] = 'No changes were made';
                header('Location: /profile');
                exit();
            }
            $this->userService->updateProfile($firstname, $lastname, $email, $id);
            $_SESSION['user_firstname'] = $firstname;
            $_SESSION['user_lastname'] = $lastname;
            $_SESSION['user_email'] = $email;
            $_SESSION['successMessage'] = $firstname . "'s profile was updated successfully";
            header('Location: /profile');
            exit();
        }
    }

    public function sendEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_SESSION['user_email'];

            try {
                $this->mailService->sendEmail($email);
                $_SESSION['successMessage'] = 'An email was sent to ' . $email . ' with a link to reset your password';
            } catch (Exception $e) {
                $_SESSION['errorMessage'] = $e->getMessage();
            }
            header('Location: /profile');
            exit();
        }
    }

    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $captchaResponse = $_POST['g-recaptcha-response'];
            $captchaSuccess = $this->userService->verifyCaptchaResponse($captchaResponse);

            if (!$captchaSuccess) {
                $_SESSION['errorMessage'] = "Verify that you are not a robot";
            }   

            $user_id = $_SESSION['user_id'];
            $email = $_SESSION['user_email'];

            $password = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

            if ($password != $confirmPassword) {
                $_SESSION['errorMessage'] = 'Passwords do not match';
                header('Location: /profile/resetPassword?token=' . $_SESSION['token']);
                exit();
            }

            if (!$this->userService->validatePassword($password)) {
                $_SESSION['errorMessage'] = 'Password must be between 8 and 20 characters';
                header('Location: /profile/resetPassword?token=' . $_SESSION['token']);
                exit();
            }

            $this->userService->updatePassword($user_id, $password);
            $_SESSION['successMessage'] = 'Password was updated successfully';
            $this->userService->deleteToken($user_id);
            $this->mailService->sendPasswordUpdatedEmail($email);

            //unset session variables
            unset($_SESSION['user_id']);
            unset($_SESSION['user_firstname']);
            unset($_SESSION['user_lastname']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_role']);
            unset($_SESSION['token']);

            header('Location: /login');
            exit();
        }

    }

    public function personalProgram()
    {
        $this->displayView($this);
    }
}