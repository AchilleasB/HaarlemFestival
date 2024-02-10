<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../services/userService.php';

class ProfileController extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
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
}