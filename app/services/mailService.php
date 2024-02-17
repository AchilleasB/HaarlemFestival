<?php
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../repositories/userRepository.php';

use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;

class MailService
{
    private $userRepository;
    private $apiKey;

    function __construct()
    {
        require_once __DIR__ . '/../config/mailconfig.php';
        $this->apiKey = $apiKey;
        $this->userRepository = new UserRepository();
    }

    public function sendEmail($email)
    {
        $user = $this->userRepository->getUserByEmail($email);
        $token = $this->generateToken();
        $this->userRepository->addToken($user->getId(), $token);

        $mail = new Mail();
        $mail->setFrom("haarlemfestivalsupp0rt@gmail.com", "Haarlem Festival Support");
        $mail->setSubject("Password Reset");
        $mail->addTo($email, $user->getFirstname() . ' ' . $user->getLastname());
        $mail->addContent("text/html", "Click <a href=\"http://localhost/profile/resetPassword?token=$token\">here</a> to reset your password");

        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($mail);

            if ($response->statusCode() == 202) {
                return true;
            } else {
                throw new Exception('Failed to send email: ' . $response->body());
            }
        } catch (Exception | TypeException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function sendPasswordUpdatedEmail ($email)
    {
        $user = $this->userRepository->getUserByEmail($email);

        $mail = new Mail();
        $mail->setFrom("haarlemfestivalsupp0rt@gmail.com", "Haarlem Festival Support");
        $mail->setSubject("Password Reset");
        $mail->addTo($email, $user->getFirstname() . ' ' . $user->getLastname());
        $mail->addContent("text/html", "Your password has been updated successfully! If you did not make this change, please contact us immediately.");

        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($mail);

            if ($response->statusCode() == 202) {
                return true;
            } else {
                throw new Exception('Failed to send email: ' . $response->body());
            }
        } catch (Exception | TypeException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

}

