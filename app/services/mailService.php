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


    
    public function sendInvoiceMail ($userMail, $invoice)
    {
        $user = $this->userRepository->getUserByEmail($userMail);

        $sendGridMail = new Mail();
        $sendGridMail->setFrom("iumahedgehogie@gmail.com", "Haarlem Festival Support");
        $sendGridMail->setSubject("Order confirmation");
        $sendGridMail->addTo($userMail, $user->getFirstname() . ' ' . $user->getLastname());
        $sendGridMail->addContent("text/html", "Your order was confirmed.");
        $file_encoded = base64_encode(file_get_contents($invoice));
        $sendGridMail->addAttachment(
            $file_encoded,
            "application/text",
            "Invoice.pdf",
            "attachment"
        );
        
        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($sendGridMail);

            if ($response->statusCode() == 202) {
                return true;
            } else {
                throw new Exception('Failed to send email: ' . $response->body());
            }
        } catch (Exception | TypeException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function sendTicketsMail($userMail, $tickets)
    {
        $user = $this->userRepository->getUserByEmail($userMail);

        $sendGridMail = new Mail();
        $sendGridMail->setFrom("iumahedgehogie@gmail.com", "Haarlem Festival Support");
        $sendGridMail->setSubject("Tickets");
        $sendGridMail->addTo($userMail, $user->getFirstname() . ' ' . $user->getLastname());
        $sendGridMail->addContent("text/html", "Download tickets.");

        foreach ($tickets as $ticket) { 
        $file_encoded = base64_encode(file_get_contents($ticket));
        $sendGridMail->addAttachment(
            $file_encoded,
            "application/text",
            "Ticket.pdf",
            "attachment"
        );}
        
        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($sendGridMail);

            if ($response->statusCode() == 202) {
                return true;
            } else {
                throw new Exception('Failed to send email: ' . $response->body());
            }
        } catch (Exception | TypeException $e) {
            throw new Exception($e->getMessage());
        }
    }


}

