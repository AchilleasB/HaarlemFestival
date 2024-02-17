<?php
require __DIR__ . '/../repositories/userRepository.php';
require_once __DIR__ . '/../models/user.php';

class UserService
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();

    }

    public function register(User $user)
    {
        return $this->userRepository->addUser($user);

    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUserIdByToken($token)
    {
       return $this->userRepository->getUserIdByToken($token);
    }

    public function isExpiredToken($token)
    {
        $token = $this->userRepository->isExpiredToken($token);
        
    }

    public function deleteToken($user_id)
    {
        $this->userRepository->deleteToken($user_id);
    }

    function userExists($email)
    {
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser) {
            return true;
        } else {
            return false;
        }
    }

    function validatePassword($password)
    {
        if ($password != null && strlen($password) >= 8 && strlen($password) <= 20) {
            return true;
        } else {
            return false;
        }
    }

    function updateProfile($firstname, $lastname, $email, $id)
    {
        $this->userRepository->updateUser($firstname, $lastname, $email, $id);
    }

    public function updatePassword($user_id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->updatePassword($user_id, $hashedPassword);
    }

    public function verifyCaptchaResponse($response) {
        $secretKey = "6LdyLWspAAAAALPIuOFykWp3rPXV4al_SiCa1f8_";
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp";
        $data = file_get_contents($url);
        $row = json_decode($data, true);

        return $row['success'];
    }

    // this function is used to register someone as customer
    // the admin and employee accounts will be mapped seperately
    // and only when in the CMS by an administrator
    function mapToCustomer($firstname, $lastname, $email, $password)
    {
        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $user->setRole(User::CUSTOMER);
        $user->setRegistrationDate(date('d-m-Y'));

        return $user;
    }

}
