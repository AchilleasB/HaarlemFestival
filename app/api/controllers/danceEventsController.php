<?php
require __DIR__ . '/../../services/danceService.php';
require_once __DIR__ . '/../../models/dance.php';
require_once __DIR__ . '/../../models/danceTicket.php';

class DanceEventsController
{
    private $danceService;

    function __construct()
    {
        $this->danceService = new DanceService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $danceEvents = $this->danceService->getAllDanceEvents();
            header('Content-Type: application/json');
            echo json_encode($danceEvents);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
            $venue_id = isset($_POST['venue_id']) ? htmlspecialchars($_POST['venue_id']) : 0;
            $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
            $start_time = isset($_POST['start_time']) ? htmlspecialchars($_POST['start_time']) : '';
            $end_time = isset($_POST['end_time']) ? htmlspecialchars($_POST['end_time']) : '';
            $session = isset($_POST['session']) ? htmlspecialchars($_POST['session']) : '';
            $tickets_available = isset($_POST['tickets_available']) ? htmlspecialchars($_POST['tickets_available']) : 0;
            $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : 0.0;

            $danceEvent = new Dance();
            $danceEvent->setId($id);
            $danceEvent->setVenueId($venue_id);
            $danceEvent->setDate($date);
            $danceEvent->setStartTime($start_time);
            $danceEvent->setEndTime($end_time);
            $danceEvent->setSession($session);
            $danceEvent->setTicketsAvailable($tickets_available);
            $danceEvent->setPrice($price);

            if ($id === 0) {
                if ($this->danceService->addDanceEvent($danceEvent)) {
                    $message = 'A new dance event added successfully';
                } else {
                    $message = 'An error occurred while adding a new dance event';
                }
            } else {
                if ($this->danceService->updateDanceEvent($danceEvent)) {
                    $message = 'The dance event updated successfully';
                } else {
                    $message = 'An error occurred while updating the dance event';
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['message'=>$message, 'danceEvent'=>$danceEvent]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($this->danceService->deleteDanceEvent($object->id)) {
                $message = 'Dance event was deleted successfully';
            } else {
                $message = 'An error occurred while deleting the dance event';
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'recipe' => $object]);
        }
    }

    public function tickets()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                header('Content-Type: application/json');
                echo json_encode('Invalid JSON');
            }

            $danceTicket = new DanceTicket();
            $danceTicket->setAmount(htmlspecialchars($object->amount));
            $danceTicket->setEventId(htmlspecialchars($object->event_id));
            $danceTicket->setUserId(htmlspecialchars($object->user_id));

            if ($object->amount === 0) {
                $message = 'Invalid amount! Try again with a valid amount of tickets';
            }
            elseif ($this->danceService->addTicketToCart($danceTicket)) {
                $message = 'Ticket(s) added to cart successfully';
            } else {
                $message = 'An error occurred while adding ticket(s) to cart';
            }

            header('Content-Type: application/json');
            echo json_encode(['message'=>$message, 'danceTicket'=>$danceTicket]);
        }
    }

}