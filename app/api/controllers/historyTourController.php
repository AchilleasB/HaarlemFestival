<?php

require_once(__DIR__ . '/../../services/historyTourService.php');
require_once __DIR__ . '/../../models/ticket.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use Ramsey\Uuid\Uuid;


class HistoryTourController 
{
    protected $historyTourService;

    public function __construct()
    {
        $this->historyTourService = new HistoryTourService();

    }  

    public function generateTicket()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not found. Please log in.']);
            exit();
        }  
    
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid JSON']);
            return;
        }

        $language = $data['language'];
        $date = $data['date'];
        $time = $data['time'];
        $quantity = $data['quantity'];
        $ticketType = $data['ticketType'];
        $user_id = $data['user_id'];

        try {
            $historyTourID = $this->historyTourService->checkForMatchingTour($language, $date, $time);
            $isFamilyTicket = strpos(strtolower($ticketType), 'family') !== false;

            $availableSeats = $this->historyTourService->getAvailableSeats($language, $date, $time);
            $requiredSeats = ($isFamilyTicket ? 4 : 1) * $quantity;

            if (!$historyTourID) {
                $message = 'No tours found';
            } elseif ($availableSeats < $requiredSeats) {
                $message = 'Not enough seats available';
            } else {
                $ticket = new Ticket();
                $ticket->setId(Uuid::uuid4()->toString());
                $ticket->setAmount($quantity);
                $ticket->setHistoryTourId($historyTourID);
                $ticket->setUserId($user_id ?: null);
                $ticketPrice = $this->historyTourService->getTicketTypePrice($ticketType);
                $calc_price = $ticketPrice * $quantity;
                $ticket->setCalcPrice($calc_price);
                $this->historyTourService->addTicketToCart($ticket);

                    //added by Maria to enable also adding history tour tickets to shopping cart by visitor
                    if(!isset($_SESSION['user_id'])){
                        if (!isset($_SESSION['selected_items_to_purchase'])){
                            $_SESSION['selected_items_to_purchase']=[];
                        }
                        $_SESSION['selected_items_to_purchase'][count($_SESSION['selected_items_to_purchase'])]=$ticket;

                    }
                    //end of added by Maria 

                    $this->historyTourService->updateSeats($historyTourID, $requiredSeats);
                    $message = 'Ticket(s) added to cart successfully';
                }
    
                echo json_encode(['message' => $message]);

            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    
    }

}
?>