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

    public function index()
    {

    }
      
    private function checkSession()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'User session not found. Please log in.']);
            //header('Location: /login');
            //exit();
        }
    }

    public function generateTicket()
    {

        $this->checkSession();
    
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
                    echo json_encode(['message' => 'No tours found for the selected language, date, and time']);
                } elseif ($availableSeats < $requiredSeats) {
                    echo json_encode(['message' => 'Not enough seats available']);
                } else {
                    
                    $ticket = new Ticket();
                    $ticket->setId( Uuid::uuid4()->toString());
                    $ticket->setAmount($quantity);
                    
                    $ticket->setHistoryTourId($historyTourID); 
                    $ticket->setUserId($user_id); 
    
                    $ticketPrice = $this->historyTourService->getTicketTypePrice($ticketType);
                    $calc_price = $ticketPrice * $quantity;
                 
                    $ticket->setCalcPrice($calc_price); 
    
                        $this->historyTourService->addTicketToCart($ticket);
                    // Start of added by Maria
                    $_SESSION['order_items_data'][count($_SESSION['order_items_data'])]=$ticket;
                    
                    // End of added by Maria
                    $this->historyTourService->updateSeats($historyTourID, $requiredSeats);
                    echo json_encode(['message' => 'Ticket generated successfully']);
                }
    

            } catch (PDOException $e) {
                
                echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
    
    }
  

}
?>
